<?php

namespace App\Entity\Security;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Security\RoleRepository")
 */
class Role
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    
    /**
     * @var Profil
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="roles")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    private $utilisateur;
    
    /**
     * @var Profil
     * @ORM\ManyToOne(targetEntity="Profil", inversedBy="roles")
     * @ORM\JoinColumn(name="profil_id", referencedColumnName="id")
     */
    private $profil;
    
    /**
     * The constructor
     */
    public function __construct()
    {
        
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
