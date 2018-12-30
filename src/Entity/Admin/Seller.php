<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 09:06
 */

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\EntityInterface;

/**
 * Class Seller
 * @package App\Entity\Admin
 * @ORM\Entity(repositoryClass="App\Repository\Admin\SellerRepository")
 */
class Seller extends Subscriber implements EntityInterface
{
    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->id;
    }

}