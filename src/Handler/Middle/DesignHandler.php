<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 30/12/2018
 * Time: 23:14
 */

namespace App\Handler\Middle;

use App\DTO\Middle\DesignDTO;
use App\Entity\Admin\Subscriber;
use App\Entity\Middle\Design;
use App\Entity\Security\User;
use App\Factory\Entity\Admin\ImageFactory;
use App\Factory\Entity\Admin\VideoFactory;
use App\Generator\MediaReferenceGenerator;
use App\Generator\PublicationReferenceGenerator;
use App\Handler\Admin\MemberHandler;
use App\Helper\Admin\AdminHelper;
use App\Helper\Generic\FileHelper;
use App\Helper\Security\UserHelper;
use App\Transformer\Admin\ImageTransformer;
use App\Transformer\Admin\VideoTransformer;
use App\Transformer\Middle\DesignTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class DesignHandler
 * @package App\Handler\Middle
 */
class DesignHandler
{
    /**
     * @var DesignTransformer
     */
    protected $designTransformer;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var FileHelper
     */
    protected $fileHelper;

    /**
     * @var ImageFactory
     */
    protected $imageFactory;

    /**
     * @var VideoFactory
     */
    protected $videoFactory;

    /**
     * @var UserHelper
     */
    protected $userHelper;

    /**
     * @var MediaReferenceGenerator
     */
    protected $mediaReferenceGenerator;

    /**
     * @var PublicationReferenceGenerator
     */
    protected $publicationReferenceGenerator;

    /**
     * @var MemberHandler
     */
    protected $memberHandler;

    /**
     * DesignHandler constructor.
     * @param DesignTransformer $designTransformer
     * @param EntityManagerInterface $entityManager
     * @param FileHelper $fileHelper
     * @param ImageFactory $imageFactory
     * @param VideoFactory $videoFactory
     * @param UserHelper $userHelper
     * @param MediaReferenceGenerator $mediaReferenceGenerator
     * @param PublicationReferenceGenerator $publicationReferenceGenerator
     * @param MemberHandler $memberHandler
     */
    public function __construct(
        DesignTransformer $designTransformer,
        EntityManagerInterface $entityManager,
        FileHelper $fileHelper,
        ImageFactory $imageFactory,
        VideoFactory $videoFactory,
        UserHelper $userHelper,
        MediaReferenceGenerator $mediaReferenceGenerator,
        PublicationReferenceGenerator $publicationReferenceGenerator,
        MemberHandler $memberHandler
    )
    {
        $this->designTransformer = $designTransformer;
        $this->entityManager = $entityManager;
        $this->fileHelper = $fileHelper;
        $this->imageFactory = $imageFactory;
        $this->videoFactory = $videoFactory;
        $this->userHelper = $userHelper;
        $this->mediaReferenceGenerator = $mediaReferenceGenerator;
        $this->publicationReferenceGenerator = $publicationReferenceGenerator;
        $this->memberHandler = $memberHandler;
    }


    /**
     * @param DesignDTO $designDTO
     * @param array $files
     * @param User $user
     * @return array
     * @throws \Exception
     */
    public function save(DesignDTO $designDTO, array $files, User $user)
    {
        $errors = array();

        /** @var Design $design */
        $design = $this->designTransformer->transforme($designDTO);

        $subscriber = $this->memberHandler->getMemberOfUser($user);
        $design->setSubscriber($subscriber);

        $design->setReference($this->publicationReferenceGenerator->getReference());
        try{
            $this->entityManager->persist($design);
            $this->entityManager->flush();

            $this->setNewFiles($design, $files, $subscriber);

            $this->entityManager->persist($design);
            $this->entityManager->flush();
        }catch (\Exception $exception){
            $errors[] = $exception->getMessage();
        }

        return $errors;
    }

    /**
     * @param Design $design
     * @param array $files
     * @param Subscriber $subscriber
     * @return Design
     */
    protected function setNewFiles(Design $design, array $files, Subscriber $subscriber)
    {
        $errors = array();
        /** @var array $file */
        foreach ($files as $file){
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $file['file'];

            if($uploadedFile === null){
                continue;
            }

            if($this->fileHelper->fileIsImage($uploadedFile)){
                $relativeFilePath = $this->saveMediaFile($design, $uploadedFile);

                //If file save failed
                if(!$relativeFilePath){
                    continue ;
                }
                $image = $this->imageFactory->create($uploadedFile, $subscriber, $design);

                $design->addMedia($image);
            }elseif ($this->fileHelper->fileIsImage($uploadedFile)){
                $video = $this->videoFactory->create();
                $design->addMedia($video);
            }
        }
        return $design;
    }

    /**
     * @param Design $design
     * @param UploadedFile $uploadedFile
     * @return null|string
     */
    protected function saveMediaFile(Design $design, UploadedFile $uploadedFile)
    {
        $fileRelativePath = null;
        try{
            $fileExtention = $uploadedFile->getExtension();
            $fileName = $this->mediaReferenceGenerator->getReference();
            $fullFileName = $fileName.".".$fileExtention;
            $fileRelativeLocation = $design->getReference();
            $fullDirectoryPath = $this->fileHelper->getMediaDirectory().DIRECTORY_SEPARATOR.$fileRelativeLocation;

            $this->fileHelper->saveUploadedFile($uploadedFile, $fullDirectoryPath, $fullFileName);
            $fileRelativePath = $fileRelativeLocation.DIRECTORY_SEPARATOR.$fullFileName;
        }catch (\Exception $exception){
            $fileRelativePath = null;
        }

        return $fileRelativePath;
    }
}