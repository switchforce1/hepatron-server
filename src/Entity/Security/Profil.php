<?php

namespace App\Entity\Security;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Model\security\RollableInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Security\ProfilRepository")
 */
class Profil
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $label;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $description;
    
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Role", mappedBy="profil")
     */
    protected $roles;

    /**
     * Profil constructor.
     */
    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }


    /**
     * 
     * @return type
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param null|string $label
     * @return Profil
     */
    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * 
     * @param string $code
     * @return \self
     */
    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * 
     * @param string $description
     * @return \self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param Role $role
     * @return $this
     */
    public function addRole(?Role $role)
    {
        $this->roles->add($role);
        $role;
        return $this;
    }

    /**
     * @param Role $role
     * @return $this
     */
    public function removeRole(Role $role)
    {
        $this->roles->removeElement($role);
        
        return $this;
    }

    /**
     * 
     * @param type $roles
     * @return $this
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }
}
