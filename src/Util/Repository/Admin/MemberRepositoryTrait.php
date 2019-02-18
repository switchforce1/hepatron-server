<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 23/01/2019
 * Time: 02:12
 */

namespace App\Util\Repository\Admin;


use App\Entity\Security\User;
use Doctrine\ORM\QueryBuilder;

/**
 * Trait MemberRepositoryTrait
 * Utile dans les repository des sous classe de member
 * @package App\Util\Repository\Admin
 */
trait MemberRepositoryTrait
{
    /**
     * @param User $user
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUserId(int $userId)
    {
        /** @var QueryBuilder $queryBuilder */
         $queryBuilder = $this->createQueryBuilder('m')
            ->leftJoin("m.user", "u")
            ->andWhere('u.id = :user_id')
            ->setParameter('user_id', $userId)
         ;

         return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}