<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 23/09/2018
 * Time: 01:33
 */

namespace App\Builder\Middle;


use App\Entity\Admin\Media;
use App\Entity\Middle\Publication;
use App\Model\Admin\MediaFormModel;
use Doctrine\Common\Collections\ArrayCollection;

class PublicationBuilder
{
    /**
     * Nombre maximal de media pour une publication
     */
    const MAX_MeDIA_COUNT = 7;

    /**
     * Initialisation des medias d'une publication
     *
     *
     * @param Publication $publicationint
     * @param int $maxMediaCount
     * @return ArrayCollection
     * @throws \Exception
     */
    public function getInitMedias(Publication $publication, int $maxMediaCount = self::MAX_MeDIA_COUNT)
    {
        //Init arayCollection
        $medias = new ArrayCollection();

        if($maxMediaCount<1){
            throw new \Exception('Impossible le nombre de media à générer est insuffisant->'.self::class);
        }

        for ($count = 0; $count < $maxMediaCount ; $count ++){
            $media = new MediaFormModel();

            //$media->setPublication($publication);
            $medias->add(clone ($media));

            unset($media);
        }

        return $medias;
    }

    /**
     * @param string $subClassFullName
     * @return Publication|null
     * @throws \Exception
     */
    public function createPublication(string $subClassFullName)
    {
        if (!class_exists($subClassFullName)) {
            return null;
        }

        /** @var Publication $publication */
        $publication = new $subClassFullName();

        if (!is_subclass_of($publication, Publication::class)) {
            return null;
        }

        //recuperation des medias
        try {
            $medias = $this->getInitMedias($publication);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        //Assignation des medias
        $publication->setMedias($medias);

        return $publication;
    }
}