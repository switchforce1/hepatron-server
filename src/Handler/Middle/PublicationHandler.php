<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 02/10/2018
 * Time: 01:59
 */

namespace App\Handler\Middle;


use App\Builder\Middle\PublicationBuilder;
use App\Entity\Admin\Member;
use App\Entity\Middle\Design;
use App\Entity\Middle\Event;
use App\Entity\Middle\Publication;
use App\Entity\Middle\Shooting;
use App\Handler\Admin\MemberHandler;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class PublicationHandler
{
    /**
     * @var MemberHandler
     */
    protected $memberHandler;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * PublicationHandler constructor.
     * @param MemberHandler $memberHandler
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(MemberHandler $memberHandler,
                                EntityManagerInterface $entityManager)
    {
        $this->memberHandler = $memberHandler;
        $this->entityManager = $entityManager;
    }


    /**
     * @param Member $member
     * @return null|string
     */
    public function getPublicationFullClassName(Member $member)
    {
        //si le membre est un tailleur
        if($this->memberHandler->memberIsTailor($member)){
            return Design::class;
        }

        //si le membre est un mannequin
        if($this->memberHandler->memberIsMannequin($member)){
            return Shooting::class;
        }

        //si le membre est un tailleur
        if($this->memberHandler->memberIsEventMaker($member)){
            return Event::class;
        }

        //si le membre est un tailleur
        if($this->memberHandler->memberIsSeller($member)){
            return Design::class;
        }

        return null;
    }
}