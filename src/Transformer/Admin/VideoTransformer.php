<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 27/12/2018
 * Time: 03:42
 */

namespace App\Transformer\Admin;


use App\DTO\DTOInterface;
use App\DTO\Admin\MediaDTO;
use App\Entity\Admin\Media;
use App\Entity\EntityInterface;
use App\Factory\Entity\Admin\ImageFactory;
use App\Factory\Entity\Admin\MediaFactory;
use App\Factory\Entity\Admin\VideoFactory;
use App\Factory\Entity\Middle\PublicationFactory;
use App\Transformer\AbstractTransformer;
use App\Transformer\TransformerInterface;

class VideoTransformer extends MediaTransformer implements TransformerInterface
{
    /**
     * @var VideoFactory
     */
    protected $mediaFactory;

    /**
     * VideoTransformer constructor.
     * @param VideoFactory $mediaFactory
     */
    public function __construct(VideoFactory $mediaFactory)
    {
        $this->mediaFactory = $mediaFactory;
    }


    /**
     * @return \App\Entity\Admin\Video|EntityInterface|null
     */
    protected function createEntity()
    {
        return $this->mediaFactory->create();
    }

    /**
     * @return mixed
     */
    protected function createDTO()
    {
        return new MediaDTO();
    }

    /**
     * @param DTOInterface $dto
     * @return EntityInterface|Media
     * @throws \Exception
     */
    public function transforme(DTOInterface $dto):?EntityInterface
    {
        /** @var MediaDTO $dto*/
        if(!$dto instanceof MediaDTO){
            throw new \Exception(sprintf("Bad DTO use on Media transformer. Expected : %s 
            , got %s", MediaDTO::class, get_class($dto)));
        }
        /** @var Media $Media */
        $Media = $this->createEntity();
        $Media
            ->setRelativePath($dto->getFile()->getPath())
        ;

        return $Media;
    }

    /**
     * @param EntityInterface $entity
     * @return DTOInterface|null
     * @throws \Exception
     */
    public function revert(EntityInterface $entity):?DTOInterface
    {
        /** @var Media $entity*/
        if($entity instanceof Media){
            throw new \Exception("Bad Entity use on Media transformer");
        }
        /** @var MediaDTO $dto */
        $dto = $this->createDTO();

        return $dto;
    }
}