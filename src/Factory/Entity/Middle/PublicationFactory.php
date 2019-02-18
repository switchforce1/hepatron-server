<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 10/12/2018
 * Time: 01:13
 */

namespace App\Factory\Entity\Middle;


use App\Entity\Admin\Media;
use App\Entity\Admin\Subscriber;
use App\Entity\Middle\Publication;
use App\Factory\AbstractPublicationFactory;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Self_;

class PublicationFactory extends AbstractPublicationFactory
{
    /**
     * @return Publication
     */
    protected function initPublication()
    {
        return new Publication();
    }

    /**
     * @return Media
     */
    protected function createMedia()
    {
        return new Media();
    }

    /**
     * @param int $count
     * @param Subscriber $subscriber
     * @return ArrayCollection
     *
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
            /** @var Media $media */
            $media = $this->createMedia();
            //$media->setSubscriber($subscriber);

            $medias->add($media);
            unset($media);
        }

        return $medias;
    }
}