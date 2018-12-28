<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 27/12/2018
 * Time: 03:42
 */

namespace App\Transformer\Middle;


use App\DTO\DTOInterface;
use App\DTO\Middle\PublicationDTO;
use App\Entity\EntityInterface;
use App\Entity\Middle\Publication;
use App\Transformer\AbstractTransformer;
use App\Transformer\TransformerInterface;

class PublicationTransformer extends AbstractTransformer implements TransformerInterface
{


    /**
     * @return mixed
     */
    public function createEntity()
    {
        // TODO: Implement createEntity() method.
    }

    /**
     * @return mixed
     */
    public function createDTO()
    {
        // TODO: Implement createDTO() method.
    }

    public function transforme(DTOInterface $dto)
    {
        // TODO: Implement transforme() method.
    }

    public function revert(EntityInterface $entity)
    {
        // TODO: Implement revert() method.
    }
}