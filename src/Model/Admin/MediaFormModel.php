<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 01/10/2018
 * Time: 01:05
 */

namespace App\Model\Admin;


use App\Entity\Admin\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaFormModel
{

    /**
     * @var UploadedFile
     */
    protected $file;

    /**
     * @var int
     */
    protected $defaultWidth;

    /**
     * @var int
     */
    protected $defaultHeight;

    /**
     * MediaFormModel constructor.
     */
    public function __construct()
    {
        $this->defaultWidth = Media::DEFAULT_WIDTH;
        $this->defaultHeight = Media::DEFAULT_HEIGHT;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     * @return MediaFormModel
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return int
     */
    public function getDefaultWidth(): ?int
    {
        return $this->defaultWidth;
    }

    /**
     * @param int $defaultWidth
     * @return MediaFormModel
     */
    public function setDefaultWidth(int $defaultWidth): MediaFormModel
    {
        $this->defaultWidth = $defaultWidth;
        return $this;
    }

    /**
     * @return int
     */
    public function getDefaultHeight(): ?int
    {
        return $this->defaultHeight;
    }

    /**
     * @param int $defaultHeight
     * @return MediaFormModel
     */
    public function setDefaultHeight(int $defaultHeight): MediaFormModel
    {
        $this->defaultHeight = $defaultHeight;
        return $this;
    }

}