<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity\Security;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping\MappingException as ORM;

/**
 * Description of Utilisateur
 *
 * @author Dadja
 */
class Utilisateur extends BaseUser
{
    //put your code here
    
    /**
     * @var int 
     * @ORM\Id
     */
    private $id;
    
    /**
     * 
     * @return int
     */
    public function getId() 
    {
        return $this->id;
    }


}
