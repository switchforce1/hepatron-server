<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 06:58
 */

namespace App\Entity\Middle;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Visiblity
 * @package App\Entity\Middle
 * @ORM\Entity()
 */
class Visiblity
{
    // Every ONE
    const CODE_PUBLIC = "PUBLIC";

    //FOLLOWERS
    const CODE_FOLLOWERS = "FOLLOWERS";

    //Partner ship
    const CODE_PROTECTED = "PROTECTED";

    //LIMITED to designed persons
    const CODE_PRIVATE = "PRIVATE";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $label;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $code;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Visiblity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return Visiblity
     */
    public function setLabel(string $label): Visiblity
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Visiblity
     */
    public function setCode(string $code): Visiblity
    {
        $this->code = $code;
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
     * @return Visiblity
     */
    public function setDescription(string $description): Visiblity
    {
        $this->description = $description;
        return $this;
    }
}