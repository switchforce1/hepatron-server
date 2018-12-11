<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 12/11/2018
 * Time: 00:07
 */

namespace App\Generator;


use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractReferenceGenerator
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManger;
    
    /**
     * @return string
     */
    abstract  protected function getEntityName();

    /**
     * @return string
     */
    abstract public function getReferencePrefix();

    /**
     * @return int
     */
    protected function getLastReference()
    {
        $entityName = $this->getEntityName();

        $maxReference = $this->entityManger->getRepository($entityName)->findMaxReference();

        return ($maxReference)? $maxReference : 0;
    }
}