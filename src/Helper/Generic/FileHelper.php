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

    /**
     * @return array
     */
    protected function getVideoMimeTypes()
    {
        $mimeTypes = array(
            "video/mp4",
            "video/quicktime",
            "video/x-msvideo",
            "video/x-flv",
            "video/web",
            "video/mpeg",
            "video/ogg",
            "video/3gpp",
        );

        return $mimeTypes;
    }

    /**
     * @return array
     */
    protected function getImageMimeTypes()
    {
        $mimeTypes = array(
            "image/gif",
            "image/jpeg",
            "image/pjpeg",
            "image/png",
            "image/tiff",
            "image/vnd.microsoft.icon",
            "image/x-icon",
            "image/webp",
        );

        return $mimeTypes;
    }

    /**
     * @param UploadedFile $file
     * @return bool
     */
    public function fileIsVideo(UploadedFile $file)
    {
        $mimeType = $file->getMimeType();

        return in_array($mimeType, $this->getVideoMimeTypes());
    }

    /**
     * @param UploadedFile $file
     * @return bool
     */
    public function fileIsImage(UploadedFile $file)
    {
        $mimeType = $file->getMimeType();

        return in_array($mimeType, $this->getImageMimeTypes());
    }
}