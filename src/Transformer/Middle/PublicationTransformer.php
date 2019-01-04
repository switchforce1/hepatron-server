<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 27/12/2018
 * Time: 03:42
 */

namespace App\Transformer\Middle;


use App\DTO\Admin\MediaDTO;
use App\DTO\DTOInterface;
use App\DTO\Middle\PublicationDTO;
use App\Entity\EntityInterface;
use App\Entity\Middle\Publication;
use App\Factory\Entity\Middle\PublicationFactory;
use App\Transformer\AbstractTransformer;
use App\Transformer\Admin\ImageTransformer;
use App\Transformer\Admin\MediaTransformer;
use App\Transformer\Admin\VideoTransformer;
use App\Transformer\TransformerInterface;

class PublicationTransformer extends AbstractTransformer implements TransformerInterface
{
    /**
     * @var PublicationFactory
     */
    protected $publicationFactory;

    /**
     * @var ImageTransformer
     */
    protected $imageTransformer;

    /**
     * @var VideoTransformer
     */
    protected $videoTransformer;

    /**
     * PublicationTransformer constructor.
     * @param PublicationFactory $publicationFactory
     * @param ImageTransformer $imageTransformer
     * @param VideoTransformer $videoTransformer
     */
    public function __construct(
        PublicationFactory $publicationFactory,
        ImageTransformer $imageTransformer,
        VideoTransformer $videoTransformer
    )
    {
        $this->publicationFactory = $publicationFactory;
        $this->imageTransformer = $imageTransformer;
        $this->videoTransformer = $videoTransformer;
    }


    /**
     * @return EntityInterface|Publication
     * @throws \Exception
     */
    protected function createEntity()
    {
        return $this->publicationFactory->create();
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
        if($dto instanceof PublicationDTO){
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