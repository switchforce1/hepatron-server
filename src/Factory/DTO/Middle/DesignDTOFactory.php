<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 23/09/2018
 * Time: 01:33
 */

namespace App\Factory\DTO\Middle;


use App\DTO\Admin\MediaDTO;
use App\DTO\Middle\DesignDTO;
use App\DTO\Middle\PublicationDTO;
use App\Entity\Middle\Design;
use App\Factory\AbstractPublicationFactory;
use App\Factory\Media;

class DesignDTOFactory extends AbstractPublicationFactory
{
    /**
     * @return PublicationDTO
     * @throws \Exception
     */
    public function create()
    {
        return parent::create();
    }


    /**
     * @return DesignDTO
     */
    protected function initPublication()
    {
        return new DesignDTO();
    }

    /**
     * @return MediaDTO|Media
     */
    protected function createMedia()
    {
        return new MediaDTO();
    }
}