<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 15/08/2018
 * Time: 10:07
 */

namespace App\DataLoader\Security;

use App\DataLoader\LoaderInterface;

/**
 * Class ProfilLoader
 * @package App\DataLoader\Security
 */
class ProfilLoader implements LoaderInterface
{

    /**
     * ProfilLoader constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return bool
     */
    public function load(): Boolean
    {
        // TODO: Implement load() method.
    }

    /**
     * @return array|null
     */
    public function getLoadData(): ?array
    {
        // TODO: Implement getLoadData() method.
    }
}