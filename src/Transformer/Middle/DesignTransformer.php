<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 27/12/2018
 * Time: 03:42
 */

namespace App\Transformer\Middle;


use App\DTO\DTOInterface;
use App\DTO\Middle\PublicationDTO;
use App\Entity\EntityInterface;
use App\Entity\Middle\Publication;
use App\Factory\Entity\Middle\DesignFactory;
use App\Factory\Entity\Middle\PublicationFactory;
use App\Transformer\AbstractTransformer;
use App\Transformer\Admin\MediaTransformer;
use App\Transformer\TransformerInterface;

class DesignTransformer extends PublicationTransformer implements TransformerInterface
{
    /**
     * @var DesignFactory
     */
    protected $designFactory;

    /**
     * @var MediaTransformer
     */
    protected $mediaTransformer;

    /**
     * DesignTransformer constructor.
     * @param DesignFactory $designFactory
     * @param MediaTransformer $mediaTransformer
     */
    public function __construct(DesignFactory $designFactory, MediaTransformer $mediaTransformer)
    {
        $this->designFactory = $designFactory;
        $this->mediaTransformer = $mediaTransformer;
    }


    /**
     * @return EntityInterface|Publication
     * @throws \Exception
     */
    protected function createEntity()
    {
        return $this->designFactory->create();
    }

    /**
     * @return mixed
     */
    protected function createDTO()
    {
        return new PublicationDTO();
    }

    /**
     * @param DTOInterface $dto
     * @return EntityInterface
     * @throws \Exception
     */
    public function transforme(DTOInterface $dto):EntityInterface
    {
        /** @var PublicationDTO $dto*/
        if($dto instanceof DesignD){
            throw new \Exception("Bad DTO use on Publication transformer");
        }
        /** @var Publication $publication */
        $publication = $this->createEntity();
        $publication
            ->setLabel($dto->getLabel())
            ->setDescription($dto->getDescription())
            ->setCreationDate($dto->getCreationDate())
            ->setVisibility($dto->getVisibility())
        ;
        foreach ($dto->getMedias() as $dtoMedia){
            $publication->addMedia($this->mediaTransformer->transforme($dtoMedia));
        }

        return $publication;
    }

    /**
     * @param EntityInterface $entity
     * @return DTOInterface|null
     * @throws \Exception
     */
    public function revert(EntityInterface $entity):?DTOInterface
    {
        /** @var Publication $entity*/
        if($entity instanceof Publication){
            throw new \Exception("Bad Entity use on Publication transformer");
        }
        /** @var PublicationDTO $dto */
        $dto = $this->createDTO();
        $dto
            ->setLabel($entity->getLabel())
            ->setDescription($entity->getDescription())
            ->setCreationDate($entity->getCreationDate())
            ->setVisibility($entity->getVisibility())
        ;

        return $dto;
    }
}