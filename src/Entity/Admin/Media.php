<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 05:37
 */

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseFile
 * @package App\Entity\Admin
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"media" = "Media", "image" = "Image", "video" = "Video"})
 */
class Media extends BaseFile
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * The default width in pixel
     * @var float
     */
    protected $defaultWidth;

    /**
     * The default heigth in pixel
     * @var float
     */
    protected $defaultHeigth;

    /**
     * @var Subscriber
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Subscriber", inversedBy="medias")
     * @ORM\JoinColumn(name="subcriber_id", nullable=false)
     */
    protected $subscriber;

    /**
     * @var Subscriber
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Middle\Publication", inversedBy="medias")
     * @ORM\JoinColumn(name="publication_id", nullable=true)
     */
    protected $publication;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getDefaultWidth(): ?float
    {
        return $this->defaultWidth;
    }

    /**
     * @param float $defaultWidth
     * @return Media
     */
    public function setDefaultWidth(float $defaultWidth): Media
    {
        $this->defaultWidth = $defaultWidth;
        return $this;
    }

    /**
     * @return float
     */
    public function getDefaultHeigth(): ?float
    {
        return $this->defaultHeigth;
    }

    /**
     * @param float $defaultHeigth
     * @return Media
     */
    public function setDefaultHeigth(float $defaultHeigth): Media
    {
        $this->defaultHeigth = $defaultHeigth;
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
     * @return Media
     */
    public function setSubscriber(?Subscriber $subscriber): Media
    {
        $this->subscriber = $subscriber;
        return $this;
    }

    /**
     * @return Subscriber
     */
    public function getPublication(): Subscriber
    {
        return $this->publication;
    }

    /**
     * @param Subscriber $publication
     * @return Media
     */
    public function setPublication(Subscriber $publication): Media
    {
        $this->publication = $publication;
        return $this;
    }
}