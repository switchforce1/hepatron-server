<?php

namespace App\Model\Security;

/**
 * Represente les class auxquels on associes des roles
 * @author Dadja
 */
interface RollableInterface
{
    /**
     * Return roles
     */
    public function getRoles():array;
}
