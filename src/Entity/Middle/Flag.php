<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 06:50
 */

namespace App\Entity\Middle;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Flag (Representation en emojis)
 * @package App\Entity\Middle
 * @ORM\Entity(repositoryClass="App\Repository\Middle\FlagRepository")
 */
class Flag
{
    //Pousse
    const CODE_LIKE = 1;
    //COEUR
    const CODE_LOVE = 2;
    //WAOUHH
    const CODE_WAOUH = 3;
    //GRISAILLEMENT
    const CODE_GRRH = 4;
    //Applaudire
    const CODE_CLAP = 5;

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
     * @ORM\Column(type="string", length=100)
     */
    protected $code;

    /**
     * @var string
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
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return Flag
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return Flag
     */
    public function setCode($code)
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
     * @return Flag
     */
    public function setDescription(string $description): Flag
    {
        $this->description = $description;
        return $this;
    }


}