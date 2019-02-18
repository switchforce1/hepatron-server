<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 17/02/2019
 * Time: 03:41
 */

namespace App\Generator;


use App\Entity\Middle\Publication;
use App\Helper\Generic\StringHelper;
use Doctrine\ORM\EntityManagerInterface;

class PublicationReferenceGenerator extends AbstractReferenceGenerator implements ReferenceGeneratorInterface
{
    /**
     * @var StringHelper
     */
    protected $stringHelper;

    /**
     * PublicationReferenceGenerator constructor.
     * @param EntityManagerInterface $entityManger
     * @param StringHelper $stringHelper
     */
    public function __construct(EntityManagerInterface $entityManger, StringHelper $stringHelper)
    {
        $this->stringHelper = $stringHelper;
        parent::__construct($entityManger);
    }


    /**
     * @return string
     */
    protected function getEntityName()
    {
        return Publication::class;
    }

    /**
     * @return string
     */
    protected function getReferencePrefix()
    {
        $dateString = (new \DateTime('now'))->format("Ymd_His");
        return "PUBLICATION".$dateString;
    }

    /**
     * @return int
     */
    public function getReference()
    {
        $uniqueString = $this->stringHelper->generateRandomString(14);
        return $this->getReferencePrefix().$uniqueString;
    }
}