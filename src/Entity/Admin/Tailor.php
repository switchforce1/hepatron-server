<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 04/08/2018
 * Time: 23:01
 */

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\EntityInterface;

/**
 * Description of Tailor
 *
 * @author Dadja
 * @ORM\Entity(repositoryClass="App\Repository\Admin\TailorRepository")
 */
class Tailor extends Subscriber implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Partnership", inversedBy="tailors")
     * @ORM\JoinColumn(name="partnership_id", referencedColumnName="id")
     */
    protected $partnership;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPartnership()
    {
        return $this->partnership;
    }

    /**
     * @param mixed $partnership
     * @return Tailor
     */
    public function setPartnership($partnership)
    {
        $this->partnership = $partnership;
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