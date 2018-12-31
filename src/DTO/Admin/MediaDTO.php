<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 01/10/2018
 * Time: 01:05
 */

namespace App\DTO\Admin;

use App\DTO\DTOInterface;
use App\Entity\Admin\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaDTO implements DTOInterface
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
     * @return UploadedFile
     */
    public function getFile(): UploadedFile
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file): void
    {
        $this->file = $file;
    }

    /**
     * @return int
     */
    public function getDefaultWidth(): int
    {
        return $this->defaultWidth;
    }

    /**
     * @param int $defaultWidth
     */
    public function setDefaultWidth(int $defaultWidth): void
    {
        $this->defaultWidth = $defaultWidth;
    }

    /**
     * @return int
     */
    public function getDefaultHeight(): int
    {
        return $this->defaultHeight;
    }

    /**
     * @param int $defaultHeight
     */
    public function setDefaultHeight(int $defaultHeight): void
    {
        $this->defaultHeight = $defaultHeight;
    }
}