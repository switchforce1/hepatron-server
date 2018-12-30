<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 17:17
 */

namespace App\Entity\Middle;

use App\Entity\Admin\Mannequin;
use App\Entity\Admin\Subscriber;
use App\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Shooting
 * @package App\Entity\Middle
 * @ORM\Entity(repositoryClass="App\Repository\Middle\ShootingRepository")
 */
class Shooting extends Publication implements EntityInterface
{
    /**
     * @param Subscriber $subscriber
     * @return Publication
     */
    public function setSubscriber(Subscriber $subscriber): Publication
    {
        return parent::setSubscriber($subscriber);
    }


}