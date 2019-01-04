<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 31/12/2018
 * Time: 14:15
 */

namespace App\Factory;


use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractPublicationFactory extends AbstractFactory
{
    const DEFAUT_MEDIA_MAX_NUMBER = 3;
    const PREMIUM_MEDIA_MAX_NUMBER = 8;

    /**
     * @return mixed
     */
    abstract protected function initPublication();

    /**
     * @return mixed
     */
    abstract protected function createMedia();

    /**
     * @return mixed
     * @throws \Exception
     */
    public function create()
    {
        $publication = $this->initPublication();
        $medias = $this->getDefaultMediaCollection();
        $publication->setMedias($medias);

        return $publication;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function premiumCreate()
    {
        $publication = $this->initPublication();
        $medias = $this->getFullMediaCollection();
        $publication->setMedias($medias);

        return $publication;
    }

    /**
     * @return ArrayCollection
     * @throws \Exception
     */
    protected function getDefaultMediaCollection()
    {
        $medias = $this->getMedias(self::PREMIUM_MEDIA_MAX_NUMBER);
        return $medias;
    }

    /**
     * @return ArrayCollection
     * @throws \Exception
     */
    protected function getFullMediaCollection()
    {
        $medias = $this->getMedias(self::PREMIUM_MEDIA_MAX_NUMBER);

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
}