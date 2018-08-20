<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 19/08/2018
 * Time: 20:32
 */

namespace App\Helper\Middle;


use Symfony\Component\HttpKernel\KernelInterface;

class FileHelper
{
    const FILES_RELATIVE_PATH = 'files';

    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * FileHelper constructor.
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @return string
     */
    public function getRootDir()
    {
       return $this->kernel->getRootDir();
    }

    /**
     * @return mixed
     */
    public function getProjetDir()
    {
        return $this->kernel->getProjectDir();
    }
}