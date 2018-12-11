<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 10/12/2018
 * Time: 01:13
 */

namespace App\Factory\Middle;


use App\Entity\Admin\Media;
use App\Entity\Middle\Publication;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Self_;

class PublicationFactory
{
    const DEFAUT_MEDIA_MAX_NUMBER = 3;
    const PREMIUM_MEDIA_MAX_NUMBER = 8;

    /**
     * @return Publication
     * @throws \Exception
     */
    public function create()
    {
        $publication = $this->initPublication();
        $medias = $this->getMedias(self::DEFAUT_MEDIA_MAX_NUMBER);
        $publication->setMedias($medias);

        return $publication;
    }

    /**
     * @return Publication
     * @throws \Exception
     */
    public function premiumCreate()
    {
        $publication = $this->initPublication();
        $medias = $this->getMedias(self::PREMIUM_MEDIA_MAX_NUMBER);
        $publication->setMedias($medias);

        return $publication;
    }

    /**
     * @return Publication
     */
    protected function initPublication()
    {
        return new Publication();
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
    protected function getMedias(int $count = self::DEFAUT_MEDIA_MAX_NUMBER)
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
     * @return Media
     */
    protected function createMedia()
    {
        return new Media();
    }
}