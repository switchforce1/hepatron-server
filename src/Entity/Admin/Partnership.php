<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 04/08/2018
 * Time: 23:24
 */

namespace App\Entity\Admin;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Partnership
 *
 * @author Dadja
 * @ORM\Entity(repositoryClass="App\Repository\Admin\PartnershipRepository")
 */
class Partnership
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Tailor", mappedBy="partnership")
     */
    protected $tailors;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Mannequin", mappedBy="partnership")
     */
    protected $mannequins;

    /**
     * Partnership constructor.
     */
    public function __construct()
    {
        $this->tailors = new ArrayCollection();
        $this->mannequins = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Partnership
     */
    public function setId(int $id): Partnership
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTailors()
    {
        return $this->tailors;
    }

    /**
     * @param Tailor $tailor
     * @return $this
     */
    public function addTailor(Tailor $tailor)
    {
        $this->tailors[] = $tailor;
        $tailor->setPartnership($this);

        return $this;
    }

    /**
     * @param Tailor $tailor
     * @return $this
     */
    public function removeTailor(Tailor $tailor)
    {
        $tailor->setPartnership(null);
        $this->tailors->removeElement($tailor);

        return $this;
    }

    /**
     * @param mixed $tailors
     * @return Partnership
     */
    public function setTailors($tailors)
    {
        $this->tailors = $tailors;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMannequins()
    {
        return $this->mannequins;
    }

    /**
     * @param Mannequin $mannequin
     * @return $this
     */
    public function addMannequin(Mannequin $mannequin)
    {
        $this->mannequins[] = $mannequin;
        $mannequin->setPartnership($this);

        return $this;
    }

    /**
     * @param Mannequin $mannequin
     * @return $this
     */
    public function removeMannequin(Mannequin $mannequin)
    {
        $mannequin->setPartnership(null);
        $this->mannequins->removeElement($mannequin);

        return $this;
    }

    /**
     * @param mixed $mannequins
     * @return Partnership
     */
    public function setMannequins($mannequins)
    {
        $this->mannequins = $mannequins;
        return $this;
    }
}