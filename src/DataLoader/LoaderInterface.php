<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 15/08/2018
 * Time: 10:09
 */

namespace App\DataLoader;


use phpDocumentor\Reflection\Types\Boolean;

interface LoaderInterface
{

    /**
     * @return bool
     */
    public function load():Boolean;

    /**
     * @return array|null
     */
    public function getLoadData(): ?array;

}