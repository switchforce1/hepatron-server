<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 04/08/2018
 * Time: 22:59
 */

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Security\User;

/**
 * Class Member
 * @package App\Entity\Admin
 * @ORM\MappedSuperclass
 */
class Member
{

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Security\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return Member
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}