<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 17:55
 */

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Image
 * @package App\Entity\Admin
 * @ORM\Entity(repositoryClass="App\Repository\Admin\ImageRepository")
 */
class Image extends Media
{

}