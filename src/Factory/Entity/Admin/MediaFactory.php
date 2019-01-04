<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 23/09/2018
 * Time: 01:35
 */

namespace App\Factory\Entity\Admin;


use App\Entity\Admin\Image;
use App\Entity\Admin\Media;
use App\Entity\Admin\Subscriber;
use App\Entity\Admin\Video;
use App\Entity\Middle\Publication;
use App\Helper\Generic\FileHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

Abstract class MediaFactory
{
    /**
     * @var FileHelper
     */
    protected $fileHelper;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * MediaFactory constructor.
     * @param FileHelper $fileHelper
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(FileHelper $fileHelper, EntityManagerInterface $entityManager)
    {
        $this->fileHelper = $fileHelper;
        $this->entityManager = $entityManager;
    }


    /**
     * @return mixed|Video|Image
     */
    abstract protected function initMedia();

    /**
     * @param UploadedFile $uploadedFile
     * @param Subscriber $subscriber
     * @param Publication $publication
     * @param string $relativeDirectory
     * @param string $fullFileName
     * @return Image|Media|Video|null
     */
    public function create(
        UploadedFile $uploadedFile,
        Subscriber $subscriber,
        Publication $publication,
        string $relativeDirectory,
        string $fullFileName
    )
    {
        /** @var Media|Video|Image $media */
        $media  = $this->initMedia();


        /** @var string $fullDirectory */
        $fullDirectory = $this->fileHelper->getMediaDirectory().DIRECTORY_SEPARATOR.$relativeDirectory;

        $isSaved = $this->fileHelper->saveUploadedFile($uploadedFile, $fullDirectory, $fullFileName);

        //if file saving failed
        if(!$isSaved){
            return null;
        }

        $media->setRelativePath($relativeDirectory.DIRECTORY_SEPARATOR.$fullFileName);
        $media->setPublication($publication);
        $media->setSubscriber($subscriber);

        return $media;
    }
}