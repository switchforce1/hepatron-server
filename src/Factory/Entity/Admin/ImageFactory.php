<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 23/09/2018
 * Time: 01:36
 */

namespace App\Factory\Entity\Admin;


use App\Entity\Admin\Image;
use App\Entity\Admin\Media;

class ImageFactory extends MediaFactory
{
    /**
     * @return Image
     */
    protected function initMedia()
    {
        return new Image();
    }
}