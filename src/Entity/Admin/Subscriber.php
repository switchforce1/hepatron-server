<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 09:02
 */

namespace App\Entity\Admin;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"subscriber" = "Subscriber", "mannequin" = "Mannequin",
 *      "tailor" = "Tailor", "seller" = "Seller", "event_maker" = "EventMaker"})
 */
class Subscriber extends Member
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Admin\Media", mappedBy="subscriber")
     */
    protected $medias;

    /**
     * Subscriber constructor.
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getMedias(): ?ArrayCollection
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
        $media->setSubscriber($this);

        return $this;
    }

    /**
     * @param Media $media
     * @return $this
     */
    public function removeMedia(Media $media)
    {
        $media->setSubscriber(null);
        $this->medias->removeElement($media);

        return $this;
    }

    /**
     * @param ArrayCollection $medias
     * @return Subscriber
     */
    public function setMedias(?ArrayCollection $medias): Subscriber
    {
        $this->medias = $medias;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->id;
    }
}