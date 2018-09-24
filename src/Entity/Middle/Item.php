<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 17:19
 */

namespace App\Entity\Middle;

use App\Entity\Admin\Seller;
use App\Entity\Admin\Subscriber;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Item (Seller publication)
 * @package App\Entity\Middle
 * @ORM\Entity(repositoryClass="App\Repository\Middle\ItemRepository")
 */
class Item extends Publication
{

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Middle\DesignItem", mappedBy="item")
     */
    protected $designItems;

    /**
     * @param Subscriber $subscriber
     * @return Publication
     */
    public function setSubscriber(Subscriber $subscriber): Publication
    {
        return parent::setSubscriber($subscriber);
    }


}