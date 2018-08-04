<?php

namespace Entity\Security;

use App\Entity\Security\ParticularAccesse;
use App\Entity\Security\Profil;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use App\Model\security\RollableInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Utilisateur
 *
 * @author Dadja
 * @ORM\Entity(repositoryClass="App\Repository\Security\UserRepository")
 */
class User extends BaseUser
{
    //put your code here
    
    /**
     * @var int 
     * @ORM\Id
     * @ORM\Column(name='id')
     */
    protected $id;

    /**
     * @var Profil
     *
     * @ManyToOne(targetEntity="Profil")
     * @JoinColumn(name="profil_id", referencedColumnName="id")
     */
    protected $profil;

    /**
     * One Product has One Shipment.
     * @var ParticularAccesse
     *
     * @ORM\OneToOne(targetEntity="ParticularAccesse")
     * @ORM\JoinColumn(name="particular_access_id", referencedColumnName="id")
     */
    private $paticularAccess;
    
    /**
     * The constructor
     */
    public function __construct()
    {
    }
    
    /**
     * 
     * @return int
     */
    public function getId() 
    {
        return $this->id;
    }



    /**
     * @inheritDoc
     */
    public function getRoles():array
    {
        return parent::getRoles(); // TODO: Change the autogenerated stub
    }

    /**
     * @return Profil
     */
    public function getProfil(): Profil
    {
        return $this->profil;
    }

    /**
     * @param Profil $profil
     * @return User
     */
    public function setProfil(Profil $profil): User
    {
        $this->profil = $profil;
        return $this;
    }

    /**
     * @return ParticularAccesse
     */
    public function getPaticularAccess(): ParticularAccesse
    {
        return $this->paticularAccess;
    }

    /**
     * @param ParticularAccesse $paticularAccess
     * @return User
     */
    public function setPaticularAccess(ParticularAccesse $paticularAccess): User
    {
        $this->paticularAccess = $paticularAccess;
        return $this;
    }



}
