<?php

namespace App\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use App\Model\security\RollableInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Security\ProfilRepository")
 */
class Profil implements RollableInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;
    
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Role", mappedBy="profil")
     */
    private $roles;

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
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * 
     * @param string $label
     * @return \self3
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * 
     * @param string $code
     * @return \self
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * 
     * @param string $description
     * @return \self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    
     /**
     * 
     * @return type
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * 
     * @param \Entity\Security\Role $role
     */
    public function addRole(Role $role)
    {
        $this->roles->addElement($role);
        $role;
        return $this;
    }
    
    /**
     * 
     * @param \Entity\Security\Role $role
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
