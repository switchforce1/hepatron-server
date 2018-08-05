<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 17:17
 */

namespace App\Entity\Middle;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Design
 * @package App\Entity\Middle
 * @ORM\Entity()
 */
class Design extends Publication
{

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Middle\DesignItem", mappedBy="design")
     */
    protected $designItems;

    /**
     * Design constructor.
     */
    public function __construct()
    {
        $this->designItems = new ArrayCollection();
    }


}