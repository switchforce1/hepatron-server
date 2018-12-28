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
     * @return EntityInterface
     */
    public function createEntity();

    /**
     * @return DTOInterface
     */
    public function createDTO();

    /**
     * @return mixed
     */
    public function transforme(DTOInterface $dto);

    /**
     * @return mixed
     */
    public function revert(EntityInterface $entity);
}