<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 27/12/2018
 * Time: 00:58
 */

namespace App\DTO\Middle;


use App\DTO\DTOInterface;
use Doctrine\Common\Collections\ArrayCollection;

class ShootingDTO extends PublicationDTO implements DTOInterface
{
    /**
     * PublicationDTO constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}