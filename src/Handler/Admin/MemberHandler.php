<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 07/09/2018
 * Time: 18:55
 */

namespace App\Handler\Admin;

use App\Entity\Admin\Member;
use App\Entity\Security\Profil;
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
     * @throws \Exception
     */
    public function getImages()
    {
        throw  new \Exception('NO content yet');
    }

    /**
     * @throws \Exception
     */
    public function getPublications()
    {
        throw  new \Exception('NO content yet');
    }

    /**
     * @param User $user
     *
     * @return null|object
     */
    public function getMemberOfUser(User $user)
    {
        $memberClass = $this->userHelper->getMemberClassFor($user);

        if(!$memberClass){
            return null;
        }

        $member = $this->entityManager->getRepository($memberClass)->findOneBy([
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

    /**
     * @param Member $member
     * @return bool
     */
    public function memberIsSeller(Member $member)
    {
        return $this->userHelper->userIsSeller($member->getUser());
    }

    /**
     * @param Member $member
     * @return bool
     */
    public function memberIsTailor(Member $member)
    {
        return $this->userHelper->userIsTailor($member->getUser());
    }

    /**
     * @param Member $member
     * @return bool
     */
    public function memberIsVisitor(Member $member)
    {
        return $this->userHelper->userIsVisitor($member->getUser());
    }

    /**
     * @param Member $member
     * @return bool
     */
    public function memberIsEventMaker(Member $member)
    {
        return $this->userHelper->userIsEventMaker($member->getUser());
    }

    /**
     * @param Member $member
     * @return bool
     */
    public function memberIsMannequin(Member $member)
    {
        return $this->userHelper->userIsMannequin($member->getUser());
    }


    /**
     * @param User $user
     * @return Member
     * @throws \Exception
     */
    public function generateMember(User $user)
    {
        if($this->getMemberOfUser($user)!=null){
            throw new \Exception("The user has already one mamber");
        }

        $memberClass = $this->userHelper->getMemberClassFor($user);

        if(!$memberClass){
            throw new \Exception("Unknown profil for this user");
        }

        /** @var Member $newMember */
        $newMember = new $memberClass();
        $newMember->setUser($user);

        return $newMember;
    }

    /**
     * @param User $user
     * @return Member
     * @throws \Exception
     */
    public function createNewMember(User $user)
    {
        try{
            $member = $this->generateMember($user);
            $this->entityManager->persist($member);
            $this->entityManager->flush();
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }

        return $member;
    }


}