<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 17:17
 */

namespace App\Entity\Middle;

use App\Entity\Admin\Subscriber;
use App\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Design
 * @package App\Entity\Middle
 * @ORM\Entity(repositoryClass="App\Repository\Middle\DesignRepository")
 */
class Design extends Publication implements EntityInterface
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

    /**
     * @param Subscriber $subscriber
     * @return Publication
     */
    public function setSubscriber(Subscriber $subscriber): Publication
    {
        return parent::setSubscriber($subscriber);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getLabel();
    }
}