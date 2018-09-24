<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 24/09/2018
 * Time: 01:12
 */

namespace App\Helper\Security;


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
}