<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 31/07/2018
 * Time: 00:19
 */

namespace App\Entity\Security;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Security\ParticularAccesseRepository")
 */
class ParticularAccesse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Many ParticularAccesses have Many Roles.
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="particularAccesses")
     * @ORM\JoinTable(name="particular_accesses_roles")
     */
    private $roles;

    /**
     * ParticularAccesse constructor.
     */
    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     * @return ParticularAccesse
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }



}