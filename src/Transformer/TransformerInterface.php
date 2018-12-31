<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 27/12/2018
 * Time: 03:46
 */

namespace App\Transformer;


use App\DTO\DTOInterface;
use App\Entity\EntityInterface;

interface TransformerInterface
{
    /**
     * @return mixed
     */
    public function transforme(DTOInterface $dto):?EntityInterface;

    /**
     * @return mixed
     */
    public function revert(EntityInterface $entity):?DTOInterface;
}