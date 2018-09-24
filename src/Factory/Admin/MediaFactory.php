<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 23/09/2018
 * Time: 01:35
 */

namespace App\Factory\Admin;


use App\Helper\Middle\FileHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

Abstract class MediaFactory
{
    /**
     * @var FileHelper
     */
    protected $fileHelper;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * MediaFactory constructor.
     * @param FileHelper $fileHelper
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(FileHelper $fileHelper, EntityManagerInterface $entityManager)
    {
        $this->fileHelper = $fileHelper;
        $this->entityManager = $entityManager;
    }


    /**
     * @return mixed
     */
    protected abstract function initMedia();

    /**
     * @param UploadedFile $uploadedFile
     */
    public function create(UploadedFile $uploadedFile, Publication $publication, string $diectory)
    {
        $media  = self::init();


    }

    /**
     * @param UploadedFile $uploadedFile
     * @param $directory
     */
    protected  function saveFile(UploadedFile $uploadedFile, $directory)
    {

    }
}