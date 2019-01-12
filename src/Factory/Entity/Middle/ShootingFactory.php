<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 23/09/2018
 * Time: 01:33
 */

namespace App\Factory\Entity\Middle;


use App\Entity\Middle\Design;
use App\Entity\Middle\Shooting;

class ShootingFactory extends PublicationFactory
{
    /**
     * @return Design|\App\Entity\Middle\Publication
     */
    protected function initPublication()
    {
        return new Shooting();
    }
}