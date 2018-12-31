<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 24/09/2018
 * Time: 01:12
 */

namespace App\Helper\Security;


use App\Entity\Admin\EventMaker;
use App\Entity\Admin\Mannequin;
use App\Entity\Admin\Seller;
use App\Entity\Admin\Tailor;
use App\Entity\Admin\Visitor;
use App\Entity\Security\Profil;
use App\Entity\Security\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserHelper
{

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * UserHelper constructor.
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return User|null
     */
    public  function getCurrentUSer():?User
    {
        if (!$this->tokenStorage) {
            throw new \LogicException('Impossible de charger le module de sécurité');
        }

        /** var TokenInterface $token */
        if (null === $token = $this->tokenStorage->getToken()) {
            return null;
        }

        /** var User $user */
        if (!\is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return null;
        }

        return $user;
    }

    /**
     * Returns the class full name of the related member
     *
     * @param User $user
     * @return null|string
     */
    public function getMemberClassFor(User $user)
    {
        if($this->userIsEventMaker($user)){
            return EventMaker::class;
        }

        if ($this->userIsVisitor($user)){
            return Visitor::class;
        }

        if ($this->userIsSeller($user)){
            return Seller::class;
        }

        if ($this->userIsTailor($user)){
            return Tailor::class;
        }

        if ($this->userIsMannequin($user)){
            return Mannequin::class;
        }

        return null;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function userIsSeller(User $user)
    {
        $profil = $user->getProfil();
        if($profil->getCode() != Profil::CODE_SELLER){
            return false;
        }
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function userIsTailor(User $user)
    {
        $profil = $user->getProfil();
        if($profil->getCode() != Profil::CODE_TAILOR){
            return false;
        }
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function userIsVisitor(User $user)
    {
        $profil = $user->getProfil();
        if($profil->getCode() != Profil::CODE_VISITOR){
            return false;
        }
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function userIsEventMaker(User $user)
    {
        $profil = $user->getProfil();
        if($profil->getCode() != Profil::CODE_EVENT_MAKER){
            return false;
        }
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function userIsMannequin(User $user)
    {
        $profil = $user->getProfil();
        if($profil->getCode() != Profil::CODE_MANNEQUIN){
            return false;
        }
        return true;
    }
}