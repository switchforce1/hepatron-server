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
use App\Entity\Security\User;
use App\Helper\Generic\CsvHelper;
use App\Helper\Generic\FileHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class DevUserLoader extends DataLoader implements LoaderInterface
{
    const LOAD_ROLE_FILE_NAME = 'security'.DIRECTORY_SEPARATOR.'dev_users.csv';

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
     * @param string $profilCode
     * @return null
     */
    protected function getProfil(string $profilCode)
    {
        if(!is_string($profilCode) || $profilCode==''){
            return null;
        }

        try{
            $profil = $this->entityManager->getRepository(Profil::class)->findOneBy(array(
                'code'=>$profilCode
            ));
        }catch (\Exception $exception){
            return null;
        }


        //si aucun profil n'a été trouvé
        if(!$profil){
            return null;
        }

        return $profil;
    }


    /**
     * @param array $element
     * @return User|bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function loadElement(array $element)
    {
        $user = new User();

        $user
            ->setUsername($element[0])
            ->setPlainPassword($element[1])
            ->setEmail($element[2])
            ->setEmailCanonical($element[2])
            ->setEnabled(true)
        ;
        $profil = $this->getProfil($element[3]);
        $user->setProfil($profil);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}