<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 07/09/2018
 * Time: 18:55
 */

namespace App\Handler\Admin;

use App\Entity\Admin\Member;
use App\Entity\Security\User;
use App\Helper\Security\UserHelper;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class MemberHandler
 * @package App\Handler\Admin
 */
class MemberHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserHelper
     */
    private $userHelper;

    /**
     * MemberHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserHelper $userHelper
     */
    public function __construct(EntityManagerInterface $entityManager, UserHelper $userHelper)
    {
        $this->entityManager = $entityManager;
        $this->userHelper = $userHelper;
    }


    /**
     *
     */
    public function getImages()
    {

    }

    /**
     *
     */
    public function getPublications()
    {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
    }

    /**
     * @param User $user
     *
     * @return null|object
     */
    public function getMemberOfUser(User $user)
    {
        $member = $this->entityManager->getRepository(Member::class)->findOneBy([
           'user'=> $user,
        ]);

        return $member;
    }

    /**
     * @param Member $member
     * @return mixed
     */
    public function getUserOfMember(Member $member)
    {
        return $member->getUser();
    }

    /**
     * @param Member $member
     * @return \App\Entity\Security\Profil|null
     */
    public function getMemberProfil(Member $member)
    {
        return $member->getUser()->getProfil();
    }

    /**
     * @return Member|null
     */
    public function getCurrentMember()
    {
        /** @var User $currentUser */
        $currentUser = $this->userHelper->getCurrentUSer();

        if(null === $currentUser){
            return null;
        }

        /** @var Member $currentMember */
        $currentMember = $this->getMemberOfUser($currentUser);

        if(null === $currentMember){
            return null;
        }

        return $currentMember;

    }
}