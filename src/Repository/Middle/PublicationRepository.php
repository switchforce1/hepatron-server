<?php

namespace App\Repository\Middle;

use App\Entity\Middle\Publication;
use App\Entity\Security\Profil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CommentRepository
 * @package App\Repository\Middle
 */
class PublicationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Publication::class);
    }

//    /**
//     * @return Profil[] Returns an array of Profil objects
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
    public function findOneBySomeField($value): ?Profil
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param \DateTime|null $dateTime
     * @param int $count
     * @return mixed
     */
    public function findAllFrom(\DateTime $dateTime = null, int $count = 20)
    {
        $queryBuilder  = $this->createQueryBuilder('p')
            ->setMaxResults($count)
            ->orderBy('p.creationDate', 'DESC')
        ;
        if($dateTime){
            $queryBuilder->andWhere('p.creationDate = :datetime')
                ->setParameter('datetime', $dateTime);
        }

        return $queryBuilder->getQuery()->getResult();
    }

}
