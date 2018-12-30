<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 15/08/2018
 * Time: 10:07
 */

namespace App\DataLoader\Middle;


use App\DataLoader\DataLoader;
use App\DataLoader\LoaderInterface;
use App\Entity\Middle\Visibility;
use App\Entity\Security\Role;
use App\Helper\Generic\CsvHelper;
use App\Helper\Generic\FileHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class VisibilyLoader extends DataLoader implements LoaderInterface
{
    const LOAD_ROLE_FILE_NAME = 'middle'.DIRECTORY_SEPARATOR.'visibilities.csv';

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * RoleLoader constructor.
     * @param EntityManagerInterface $entityManager
     * @param FileHelper $fileHelper
     * @param CsvHelper $csvHelper
     */
    public function __construct(EntityManagerInterface $entityManager, FileHelper $fileHelper, CsvHelper $csvHelper)
    {
        $this->entityManager = $entityManager;
        parent::__construct($fileHelper, $csvHelper);
    }

    /**
     * Recupere le nom du fichier de données
     * @return string
     */
    protected function getLoadDataFilePath(): string
    {
        return parent::getLoadDataDirectory().DIRECTORY_SEPARATOR.self::LOAD_ROLE_FILE_NAME;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function load(): bool
    {
        return parent::load();
    }

    /**
     * @param array $element
     * @return Visibility|bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function loadElement(array $element)
    {
        $visibility = new Visibility();

        $visibility
            ->setCode($element[0])
            ->setLabel($element[1])
            ->setDescription($element[2])
        ;

        $this->entityManager->persist($visibility);
        $this->entityManager->flush();

        return $visibility;
    }
}