<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 12/11/2018
 * Time: 00:07
 */

namespace App\Generator;


use Doctrine\ORM\EntityManagerInterface;

interface ReferenceGeneratorInterface
{
    /**
     * @return int
     */
    public function getReference();
}