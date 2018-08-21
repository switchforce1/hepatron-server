<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 15/08/2018
 * Time: 10:07
 */

namespace App\DataLoader\Security;

use App\DataLoader\DataLoader;
use App\DataLoader\LoaderInterface;
use App\Entity\Security\Profil;
use App\Helper\Middle\CsvHelper;
use App\Helper\Middle\FileHelper;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ProfilLoader
 * @package App\DataLoader\Security
 */
class ProfilLoader extends DataLoader implements LoaderInterface
{

    const LOAD_PROFIL_FILE_NAME = 'security'.DIRECTORY_SEPARATOR.'profils.csv';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ProfilLoader constructor.
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
     * @return bool
     * @throws \Exception
     */
    public function load(): bool
    {
        return parent::load();
    }

    /**
     * @param array $element
     * @return bool
     */
    protected function loadElement(array $element)
    {
        $profil = new Profil();

        $profil
            ->setCode($element[0])
            ->setLabel($element[1])
            ->setDescription($element[2])
        ;

        $this->entityManager->persist($profil);
        $this->entityManager->flush();

        return true;
    }

    /**
     * @return array|null
     * @throws \Exception
     */
    public function getLoadData(): ?array
    {
        return parent::getLoadData();
    }

    /**
     * Recupere le nom du fichier de données
     * @return string
     */
    protected function getLoadDataFilePath(): string
    {
        return parent::getLoadDataDirectory().DIRECTORY_SEPARATOR.self::LOAD_PROFIL_FILE_NAME;
    }
}