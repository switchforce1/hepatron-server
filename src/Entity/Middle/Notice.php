<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 06:47
 */

namespace App\Entity\Middle;

use App\Entity\Admin\Subscriber;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Notice
 * @package App\Entity\Middle
 * @ORM\Entity(repositoryClass="App\Repository\Middle\NoticeRepository")
 */
class Notice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var Subscriber
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Subscriber")
     * @ORM\JoinColumn(name="subscriber_id", nullable=false)
     */
    protected $subscriber;

    /**
     * @var Publication
     * @ORM\ManyToOne(targetEntity="App\Entity\Middle\Publication")
     * @ORM\JoinColumn(name="publication_id", nullable=false)
     */
    protected $publication;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Subscriber
     */
    public function getSubscriber(): ?Subscriber
    {
        return $this->subscriber;
    }

    /**
     * @param Subscriber $subscriber
     * @return Notice
     */
    public function setSubscriber(Subscriber $subscriber): Notice
    {
        $this->subscriber = $subscriber;
        return $this;
    }

    /**
     * @return Publication
     */
    public function getPublication(): ?Publication
    {
        return $this->publication;
    }

    /**
     * @param Publication $publication
     * @return Notice
     */
    public function setPublication(Publication $publication): Notice
    {
        $this->publication = $publication;
        return $this;
    }


}