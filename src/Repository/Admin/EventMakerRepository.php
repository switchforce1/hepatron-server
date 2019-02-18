<?php

namespace App\Repository\Admin;

use App\Entity\Admin\EventMaker;
use App\Entity\Admin\Seller;
use App\Entity\Security\Profil;
use App\Util\Repository\Admin\MemberRepositoryTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EventMaker|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventMaker|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventMaker[]    findAll()
 * @method EventMaker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventMakerRepository extends ServiceEntityRepository
{
    use MemberRepositoryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EventMaker::class);
    }

//    /**
//     * @return EventMaker[] Returns an array of EventMaker objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventMaker
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
