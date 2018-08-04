<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 04/08/2018
 * Time: 23:01
 */

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Visitor
 *
 * @author Dadja
 * @ORM\Entity(repositoryClass="App\Repository\Admin\VisitorRepository")
 */
class Visitor extends Member
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


}