<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 19/08/2018
 * Time: 20:32
 */

namespace App\Helper\Generic;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;

class FileHelper
{
    const FILES_RELATIVE_PATH = 'files';

    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var string
     */
    protected $mediaDirectory;

    /**
     * FileHelper constructor.
     * @param KernelInterface $kernel
     * @param $mediaDirectory
     */
    public function __construct(KernelInterface $kernel,$mediaDirectory)
    {
        $this->kernel = $kernel;
        $this->mediaDirectory = $mediaDirectory;
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

    /**
     *
     */
    public function getMediaDirectory()
    {
        return $this->mediaDirectory;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param string $directory
     * @param string $fileName
     * @return bool
     */
    public function saveUploadedFile(UploadedFile $uploadedFile, string $directory, string $fileName = "" )
    {
        try{
            if($fileName == ""){
                $fileName = $uploadedFile->getClientOriginalName().$uploadedFile->getExtension();
            }

            $uploadedFile->move(
                $directory,
                $fileName
            );
            return true;
        }catch (\Exception $exception){
            return false;
        }


    }
}