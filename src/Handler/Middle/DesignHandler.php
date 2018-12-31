<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 30/12/2018
 * Time: 23:14
 */

namespace App\Handler\Middle;

use App\Transformer\Middle\DesignTransformer;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DesignHandler
 * @package App\Handler\Middle
 */
class DesignHandler
{
    /**
     * @var DesignTransformer
     */
    protected $designTransformer;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    
}