<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Image;
use App\Entity\Admin\Member;
use App\Entity\Security\Profil;
use App\Entity\Security\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Profil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Profil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Profil[]    findAll()
 * @method Profil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Image::class);
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
     * @param User $user
     * @return mixed
     */
    public function findByUser(User $user)
    {
        $queryBuilder = $this->createQueryBuilder('i')
            ->leftJoin('i.publication', 'p')
            ->leftJoin('p.subscriber', 's')
            ->andWhere('s.user = :user')
            ->setParameter('user', $user)
        ;

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param Member $member
     * @return mixed
     */
    public function findByMember(Member $member)
    {
        $queryBuilder = $this->createQueryBuilder('i')
            ->leftJoin('i.publication', 'p')
            ->andWhere('p.subscriber = :member')
            ->setParameter('member', $member)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
