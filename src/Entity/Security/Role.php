<?php

namespace App\Entity\Security;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Entity\Security\User;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Security\RoleRepository")
 */
class Role
{
    //Roles constantes
    const CODE_DEFAULT = 'ROLE_USER';
    const CODE_SUBSCRIBER = 'ROLE_SUBSCRIBER';
    const CODE_TAILOR = 'ROLE_TAILOR';
    const CODE_MANIKIN = 'ROLE_MANIKIN';
    const CODE_SELLER = 'ROLE_SELLER';
    const CODE_CARRIER = 'ROLE_CARRIER';
    const CODE_ADMIN = 'ROLE_ADMIN';
    const CODE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

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
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;
    
    /**
     * @var Profil
     * @ORM\ManyToOne(targetEntity="Profil", inversedBy="roles")
     * @ORM\JoinColumn(name="profil_id", referencedColumnName="id")
     */
    protected $profil;

    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="ParticularAccesse", mappedBy="roles")
     */
    protected $particularAccesses;
    
    /**
     * The constructor
     */
    public function __construct()
    {
        $this->particularAccesses = new ArrayCollection();
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
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * 
     * @param string $label
     * @return \self
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
     * @return type
     */
    public function getDescription()
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
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * 
     * @param type $utilisateur
     * @return $this
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    /**
     * 
     * @return type
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * 
     * @param type $profil
     * @return $this
     */
    public function setProfil($profil)
    {
        $this->profil = $profil;
        return $this;
    }


}
