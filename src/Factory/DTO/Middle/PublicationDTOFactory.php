<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 10/12/2018
 * Time: 01:13
 */

namespace App\Factory\DTO\Middle;


use App\DTO\Admin\MediaDTO;
use App\DTO\Middle\PublicationDTO;
use App\Entity\Admin\Media;
use App\Entity\Middle\Publication;
use App\Factory\Entity\Middle\PublicationFactory;
use App\Transformer\Middle\PublicationTransformer;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Self_;

class PublicationDTOFactory
{

    /**
     * @return PublicationDTO
     * @throws \Exception
     */
    public function create()
    {
        $publicationDTO = self::initPublicationDTO();
        $medias = $this->getMedias(PublicationFactory::DEFAUT_MEDIA_MAX_NUMBER);
        $publicationDTO->setMedias($medias);

        return $publicationDTO;
    }

    /**
     * @return PublicationDTO
     * @throws \Exception
     */
    public function premiumCreate()
    {
        $publicationDTO = $this->initPublicationDTO();
        $medias = $this->getMedias(PublicationFactory::PREMIUM_MEDIA_MAX_NUMBER);
        $publicationDTO->setMedias($medias);

        return $publicationDTO;
    }

    /**
     * @return PublicationDTO
     */
    protected function initPublicationDTO()
    {
        return new PublicationDTO();
    }

    /**
     * @return ArrayCollection
     */
    protected function getDefaultMediaCollection()
    {
        $medias = new ArrayCollection();
        return $medias;
    }

    /**
     * @return ArrayCollection
     */
    protected function getFullMediaCollection()
    {
        $medias = new ArrayCollection();

        return $medias;
    }

    /**
     * @param int $count
     * @return ArrayCollection
     * @throws \Exception
     */
    protected function getMedias(int $count = PublicationFactory::DEFAUT_MEDIA_MAX_NUMBER)
    {
        if($count<=0){
            throw new \Exception("The lower medias number must be at list one.");
        }
        /** @var ArrayCollection $medias */
        $medias = new ArrayCollection();

        for($i=0; $i<$count; $i++){
            $media = $this->createMedia();
            $medias->add($media);
            unset($media);
        }

        return $medias;
    }

    /**
     * @return MediaDTO
     */
    protected function createMedia()
    {
        return new MediaDTO();
    }
}