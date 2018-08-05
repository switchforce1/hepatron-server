<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 17:57
 */

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Video
 * @package App\Entity\Admin
 * @ORM\Entity(repositoryClass="App\Repository\Admin\VideoRepository")
 */
class Video extends Media
{

}