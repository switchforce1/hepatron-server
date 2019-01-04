<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 10/12/2018
 * Time: 01:13
 */

namespace App\Factory\Entity\Middle;


use App\Entity\Admin\Media;
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
}