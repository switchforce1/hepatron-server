<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 05:37
 */

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseFile
 * @package App\Entity\Admin
 * @ORM\MappedSuperclass
 */
class Picture extends BaseFile
{

    /**
     * The default width in pixel
     * @var float
     */
    protected $defaultWidth;

    /**
     * The default heigth in pixel
     * @var float
     */
    protected $defaultHeigth;
}