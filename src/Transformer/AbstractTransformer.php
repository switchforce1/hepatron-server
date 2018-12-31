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
    /**
     * @param DTOInterface $dto
     * @return EntityInterface|null
     */
    abstract public function transforme(DTOInterface $dto):?EntityInterface;

    /**
     * @param EntityInterface $entity
     * @return DTOInterface|null
     */
    abstract public function revert(EntityInterface $entity):?DTOInterface;

    /**
     * @return EntityInterface
     */
    abstract protected function createEntity();

    /**
     * @return DTOInterface
     */
    abstract protected function createDTO();
}