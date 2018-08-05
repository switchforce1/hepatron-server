<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 06:38
 */

namespace App\Entity\Middle;

use App\Entity\Admin\Media;
use App\Entity\Admin\Subscriber;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Publication
 * @package App\Entity\Middle
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"publication" = "Publication", "shooting" = "Shooting", "design" = "Design", "item" = "Item"})
 */
class Publication
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $label;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    protected $description;

    /**
     * @var Subscriber
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Subscriber")
     * @ORM\JoinColumn(name="subscriber_id", nullable=false)
     */
    protected $subscriber;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Admin\Media", mappedBy="publication")
     */
    protected $medias;

    /**
     * Publication constructor.
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return Publication
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Publication
     */
    public function setDescription(string $description): Publication
    {
        $this->description = $description;
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
     * @return Publication
     */
    public function setSubscriber(Subscriber $subscriber): Publication
    {
        $this->subscriber = $subscriber;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getMedias(): ArrayCollection
    {
        return $this->medias;
    }

    /**
     * @param Media $media
     * @return $this
     */
    public function addMedia(Media $media)
    {
        $this->medias->add($media);
        $media->setPublication($this);

        return $this;
    }

    /**
     * @param Media $media
     * @return $this
     */
    public function removeMedia(Media $media)
    {
        $media->setPublication(null);
        $this->medias->removeElement($media);

        return $this;
    }

    /**
     * @param ArrayCollection $medias
     * @return Publication
     */
    public function setMedias(ArrayCollection $medias): Publication
    {
        $this->medias = $medias;
        return $this;
    }
}