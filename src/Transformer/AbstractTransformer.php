<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 27/12/2018
 * Time: 03:34
 */

namespace App\Transformer;


use App\DTO\DTOInterface;
use App\Entity\EntityInterface;

abstract class AbstractTransformer implements TransformerInterface
{
    abstract public function transforme(DTOInterface $dto);

    abstract public function revert(EntityInterface $entity);
}