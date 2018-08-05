<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 00:33
 */

namespace App\Entity\Admin;

use App\Entity\Security\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseFile
 * @package App\Entity\Admin
 * @ORM\MappedSuperclass
 */
class BaseFile
{

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $creationDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updateDate;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $filePath;

    /**
     * @var array
     * @ORM\Column(type="array", nullable=true)
     */
    protected $detail;
}