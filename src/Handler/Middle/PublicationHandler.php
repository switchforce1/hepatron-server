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
     * @var PublicationBuilder
     */
    protected $publicationBuilder;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * PublicationHandler constructor.
     * @param MemberHandler $memberHandler
     * @param EntityManagerInterface $entityManager
     * @param PublicationBuilder $publicationBuilder
     */
    public function __construct(MemberHandler $memberHandler,
                                EntityManagerInterface $entityManager,
                                PublicationBuilder $publicationBuilder)
    {
        $this->memberHandler = $memberHandler;
        $this->entityManager = $entityManager;
        $this->publicationBuilder = $publicationBuilder;
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

    /**
     * @param Member $member
     * @return Publication|null
     * @throws \Exception
     */
    public function createPublicationFor(Member $member)
    {
        $publicationFullClassName = $this->getPublicationFullClassName($member);
        if(!$publicationFullClassName){
            return null;
        }

        /** @var Publication $publication */
        $publication =  $this->publicationBuilder->createPublication($publicationFullClassName);

        return $publication;
    }
}