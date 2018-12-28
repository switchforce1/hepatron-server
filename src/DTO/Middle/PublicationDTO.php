<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 27/12/2018
 * Time: 00:58
 */

namespace App\DTO\Middle;


use App\DTO\DTOInterface;
use Doctrine\Common\Collections\ArrayCollection;

class PublicationDTO implements DTOInterface
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var
     */
    protected $visibility;

    /**
     * @var \DateTime
     */
    protected $creationDate;

    /**
     * @var ArrayCollection
     */
    protected $medias;

    /**
     * PublicationDTO constructor.
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime('now');
        $this->medias = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return PublicationDTO
     */
    public function setLabel(string $label): PublicationDTO
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
     * @return PublicationDTO
     */
    public function setDescription(string $description): PublicationDTO
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @param mixed $visibility
     * @return PublicationDTO
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return PublicationDTO
     */
    public function setCreationDate(\DateTime $creationDate): PublicationDTO
    {
        $this->creationDate = $creationDate;
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
     * @param ArrayCollection $medias
     * @return PublicationDTO
     */
    public function setMedias(ArrayCollection $medias): PublicationDTO
    {
        $this->medias = $medias;
        return $this;
    }
}