<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 07/09/2018
 * Time: 03:01
 */

namespace App\Handler\Web\Front;

use App\Entity\Middle\Publication;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PublicationHelper
 * @package App\Handler\Web\Front
 */
class PublicationHandler
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * PublicationHelper constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \DateTime|null $dateTime
     */
    public function getPublicationFrom(\DateTime $dateTime  = null, int $count = 20 )
    {
        //si le parametre est nule
        if(!$dateTime){
            $dateTime = new \DateTime('now');
        }

        $publications = $this->entityManager->getRepository(Publication::class);
    }
}