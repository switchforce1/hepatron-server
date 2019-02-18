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
use App\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Publication
 * @package App\Entity\Middle
 *
 * @ORM\Entity(repositoryClass="App\Repository\Middle\PublicationRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"publication" = "Publication", "shooting" = "Shooting",
 *     "design" = "Design", "item" = "Item", "event" = "Event"})
 */
class Publication implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="reference", length=255)
     */
    protected $reference;

    /**
     * @ORM\Column(type="string",name="label", length=255)
     */
    protected $label;

    /**
     * @var string
     * @ORM\Column(type="text", name="description", nullable=false)
     */
    protected $description;

    /**
     * @var Visibility
     * @ORM\ManyToOne(targetEntity="App\Entity\Middle\Visibility")
     * @ORM\JoinColumn(name="visibility_id", nullable=false)
     */
    protected $visibility;

    /**
     * @var Subscriber
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Subscriber")
     * @ORM\JoinColumn(name="subscriber_id", nullable=false)
     */
    protected $subscriber;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Admin\Media",
     *     mappedBy="publication", cascade={"persist"})
     */
    protected $medias;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false, unique=false)
     */
    protected $creationDate;

    /**
     * Publication constructor.
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime('now');
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
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return Publication
     */
    public function setReference(string $reference = null): Publication
    {
        $this->reference = $reference;
        return $this;
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
    public function getDescription(): ?string
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
    public function getSubscriber(): ?Subscriber
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

    /**
     * @return Visibility
     */
    public function getVisibility(): ?Visibility
    {
        return $this->visibility;
    }

    /**
     * @param Visibility $visibility
     * @return Publication
     */
    public function setVisibility(Visibility $visibility): Publication
    {
        $this->visibility = $visibility;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): ?\DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return Publication
     */
    public function setCreationDate(\DateTime $creationDate): Publication
    {
        $this->creationDate = $creationDate;
        return $this;
    }


}