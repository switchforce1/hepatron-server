<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 18:48
 */

namespace App\Entity\Middle;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class AdvicedItemDesign
 * @package App\Entity\Middle
 * @ORM\Entity()
 */
class DesignItem
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var Item
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Middle\Item", inversedBy="designItems")
     * @ORM\JoinColumn(name="item_id", nullable=false)
     */
    protected $item;

    /**
     * @var Design
     * @ORM\ManyToOne(targetEntity="App\Entity\Middle\Design", inversedBy="designItems")
     * @ORM\JoinColumn(name="design_id", nullable=false)
     */
    protected $design;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $required = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Item
     */
    public function getItem(): ?Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     * @return DesignItem
     */
    public function setItem(Item $item): DesignItem
    {
        $this->item = $item;
        return $this;
    }

    /**
     * @return Design
     */
    public function getDesign(): ?Design
    {
        return $this->design;
    }

    /**
     * @param Design $design
     * @return DesignItem
     */
    public function setDesign(Design $design): DesignItem
    {
        $this->design = $design;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired(): ?bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     * @return DesignItem
     */
    public function setRequired(bool $required): DesignItem
    {
        $this->required = $required;
        return $this;
    }
}