<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 15/08/2018
 * Time: 10:12
 */

namespace App\DataLoader\Security;


use App\DataLoader\DataLoader;
use App\DataLoader\LoaderInterface;
use App\Entity\Security\Profil;
use App\Entity\Security\Role;
use App\Helper\Generic\CsvHelper;
use App\Helper\Generic\FileHelper;
use Doctrine\ORM\EntityManagerInterface;

class RolesProfilsLoader extends  DataLoader implements LoaderInterface
{

    const LOAD_ROLE_PROFIL_FILE_NAME = 'security'.DIRECTORY_SEPARATOR.'roles_profils.csv';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * RoleProfilLoader constructor.
     *
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
     * Recuperer le nom du fichier de données.
     *
     * @return string
     */
    protected function getLoadDataFilePath(): string
    {
        return parent::getLoadDataDirectory().DIRECTORY_SEPARATOR.self::LOAD_ROLE_PROFIL_FILE_NAME;
    }

    /**
     * @param array $element
     * @return Profil|bool
     */
    protected function loadElement(array $element)
    {
        /** @var Profil $profil */
        $profil =  $this->entityManager->getRepository(Profil::class)->findOneBy([
           'code'=> $element[0],
        ]);
        if($profil && isset($element[1])){
            $role = $this->entityManager->getRepository(Role::class)->findOneBy([
                'code'=> $element[1],
            ]);
            if($role && $role instanceof Role){
                $profil->addRole($role);
            }
        }

        $this->entityManager->flush();

        return $profil;
    }
}