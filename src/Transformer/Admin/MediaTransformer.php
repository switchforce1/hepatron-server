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
use App\Factory\Entity\Middle\PublicationFactory;
use App\Transformer\AbstractTransformer;
use App\Transformer\TransformerInterface;

class MediaTransformer extends AbstractTransformer implements TransformerInterface
{
    /**
     * @var PublicationFactory
     */
    protected $publicationFactory;

    /**
     * PublicationTransformer constructor.
     * @param PublicationFactory $publicationFactory
     */
    public function __construct(PublicationFactory $publicationFactory)
    {
        $this->publicationFactory = $publicationFactory;
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
        if($dto instanceof MediaDTO){
            throw new \Exception("Bad DTO use on Media transformer");
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