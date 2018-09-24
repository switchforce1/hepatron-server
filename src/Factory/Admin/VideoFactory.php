<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 23/09/2018
 * Time: 01:36
 */

namespace App\Factory\Admin;


use App\Entity\Admin\Video;

class VideoFactory extends MediaFactory
{
    /**
     * @return Video|mixed
     */
    protected function initMedia()
    {
        return new Video();
    }
}