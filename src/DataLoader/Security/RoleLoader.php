<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 15/08/2018
 * Time: 10:07
 */

namespace App\DataLoader\Security;


use App\DataLoader\LoaderInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class RoleLoader implements LoaderInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * RoleLoader constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, KernelInterface $kernel)
    {
        $this->entityManager = $entityManager;
        $this->kernel = $kernel;
    }

    

    /**
     * @return bool
     */
    public function load(): Boolean
    {
        // TODO: Implement load() method.
    }

    /**
     * @return array|null
     */
    public function getLoadData(): ?array
    {
        // TODO: Implement getLoadData() method.
    }
}