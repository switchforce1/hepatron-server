<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 07/09/2018
 * Time: 18:55
 */

namespace App\Handler\Admin;

use App\Entity\Admin\Member;
use App\Entity\Admin\Visitor;
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
     * Recuperer le membre correspondant à un utilisateur ou le créer au cas echéant
     *
     * @param User $user
     * @return Member|null|object
     * @throws \Exception
     */
    public function getMemberOfUser(User $user)
    {
        //On recupere la classe membre de l'utilisateur
        $memberClass = $this->userHelper->getMemberClassFor($user);

        if(!$memberClass){
            return null;
        }

        $member = $this->entityManager->getRepository($memberClass)->findOneByUserId($user->getId());

        //Si pas de membre on en cré
        if(!$member){
            return $this->createNewMember($user);
        }

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
     * @return null
     */
    protected function userIsMember(User $user)
    {
        $profil = $user->getProfil();

        //Si aucun profil ne lui est associé
        if(!$profil){
            return null;
        }
        if($profil instanceof Visitor){
            $members = $this->entityManager->getRepository(Visitor::class)->findBy(array(
                'user' => $user
            ));
            //list des membres
            if(!$members || empty($members)){
                return null;
            }
        }
    }

    /**
     * @param User $user
     * @return Member
     * @throws \Exception
     */
    protected function generateMember(User $user)
    {
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

    /**
     * @param User $user
     */
    public function userIsVisitor(User $user)
    {

    }

    /**
     * @param User $user
     * @return bool
     */
    public function userIsSubscriber(User $user)
    {
        return !$this->memberIsVisitor($user);
    }
}