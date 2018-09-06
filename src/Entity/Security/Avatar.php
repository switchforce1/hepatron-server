<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 06:33
 */

namespace App\Entity\Security;

use App\Entity\Admin\BaseFile;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Admin\Picture;

/**
 * Class Avatar
 * @package App\Entity\Security
 * @ORM\Entity(repositoryClass="App\Repository\Security\AvatarRepository")
 */
class Avatar extends BaseFile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="User")
     */
    protected $user;
}