<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 06:33
 */

namespace App\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Admin\Picture;

/**
 * Class Avatar
 * @package App\Entity\Security
 */
class Avatar extends Picture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;
}