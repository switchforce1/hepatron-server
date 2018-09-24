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
 * Class Comment (Commentaire)
 * @package App\Entity\Middle
 * @ORM\Entity(repositoryClass="App\Repository\Middle\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="content", type="text", length=255)
     */
    protected $content;

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
     * @param mixed $id
     * @return Comment
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Subscriber
     */
    public function getSubscriber(): Subscriber
    {
        return $this->subscriber;
    }

    /**
     * @param Subscriber $subscriber
     * @return Comment
     */
    public function setSubscriber(Subscriber $subscriber): Comment
    {
        $this->subscriber = $subscriber;
        return $this;
    }

    /**
     * @return Publication
     */
    public function getPublication(): Publication
    {
        return $this->publication;
    }

    /**
     * @param Publication $publication
     * @return Comment
     */
    public function setPublication(Publication $publication): Comment
    {
        $this->publication = $publication;
        return $this;
    }
}