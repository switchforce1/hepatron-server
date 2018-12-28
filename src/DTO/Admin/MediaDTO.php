<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 01/10/2018
 * Time: 01:05
 */

namespace App\DTO\Admin;

use App\Entity\Admin\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaDTO
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
}