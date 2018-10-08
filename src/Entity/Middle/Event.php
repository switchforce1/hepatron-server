<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 17:17
 */

namespace App\Entity\Middle;

use App\Entity\Admin\Subscriber;
use App\Entity\Admin\Tailor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Design
 * @package App\Entity\Middle
 * @ORM\Entity(repositoryClass="App\Repository\Middle\DesignRepository")
 */
class Event extends Publication
{

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="start_date")
     */
    protected $startDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="end_date")
     */
    protected $endDate;

    /**
     * Design constructor.
     */
    public function __construct()
    {
        $this->startDate = new \DateTime();
        $this->endDate = new \DateTime();
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
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     * @return Event
     */
    public function setStartDate(\DateTime $startDate): Event
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     * @return Event
     */
    public function setEndDate(\DateTime $endDate): Event
    {
        $this->endDate = $endDate;
        return $this;
    }
}