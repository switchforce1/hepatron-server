<?php

use Doctrine\Common\Collections\ArrayCollection;

namespace Entity\Security;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use App\Model\security\RollableInterface;

/**
 * Description of Utilisateur
 *
 * @author Dadja
 * @ORM\Entity
 */
class Utilisateur extends BaseUser implements RollableInterface
{
    //put your code here
    
    /**
     * @var int 
     * @ORM\Id
     * @ORM\Column(name='id')
     */
    protected $id;
    
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Role", mappedBy="utilisateur")
     */
    private $roles;
    
    /**
     * The constructor
     */
    public function __construct()
    {
        $this->roles = new ArrayCollection(); 
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
