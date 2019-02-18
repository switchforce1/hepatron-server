<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 05:37
 */

namespace App\Entity\Admin;

use App\Entity\Middle\Publication;
use Doctrine\ORM\Mapping as ORM;
use http\Exception\BadQueryStringException;
use App\Entity\EntityInterface;

/**
 * Class BaseFile
 * @package App\Entity\Admin
 *
 * @ORM\Entity(repositoryClass="App\Repository\Admin\MediaRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"media" = "Media", "image" = "Image", "video" = "Video"})
 */
class Media extends BaseFile implements EntityInterface
{
    const DEFAULT_WIDTH = 100;
    const DEFAULT_HEIGHT = 100;
    const DEFAULT_NAME = "UNKNOWN";
    const DEFAULT_FILE_PATH = "UNKNOWN";

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * The default width in pixel
     * @var float
     * @ORM\Column(type="float", name = "default_width")
     */
    protected $defaultWidth;

    /**
     * The default heigth in pixel
     * @var float
     * @ORM\Column(type="float", name="default_heigth")
     */
    protected $defaultHeigth;

    /**
     * @var Subscriber
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Subscriber", inversedBy="medias")
     * @ORM\JoinColumn(name="subcriber_id", nullable=true)
     */
    protected $subscriber;

    /**
     * @var Publication
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Middle\Publication", inversedBy="medias")
     * @ORM\JoinColumn(name="publication_id", nullable=true)
     */
    protected $publication;

    /**
     * Original file name from client upload
     * @var string
     * @ORM\Column(type="string", name="original_file_name", nullable=true)
     */
    protected $originalFileName;

    /**
     * Path from media principal directory
     * @var string
     * @ORM\Column(type="string", name="relative_path", nullable=true)
     */
    protected $relativePath;

    /**
     * Media constructor.
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime('now');
        $this->defaultWidth = self::DEFAULT_WIDTH;
        $this->defaultHeigth = self::DEFAULT_HEIGHT;
        $this->originalFileName = "";
        $this->name = self::DEFAULT_NAME;
        $this->filePath = self::DEFAULT_FILE_PATH;
        parent::__construct();
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getDefaultWidth(): ?float
    {
        return $this->defaultWidth;
    }

    /**
     * @param float $defaultWidth
     * @return Media
     */
    public function setDefaultWidth(float $defaultWidth): Media
    {
        $this->defaultWidth = $defaultWidth;
        return $this;
    }

    /**
     * @return float
     */
    public function getDefaultHeigth(): ?float
    {
        return $this->defaultHeigth;
    }

    /**
     * @param float $defaultHeigth
     * @return Media
     */
    public function setDefaultHeigth(float $defaultHeigth): Media
    {
        $this->defaultHeigth = $defaultHeigth;
        return $this;
    }

    /**
     * @return Subscriber
     */
    public function getSubscriber(): ?Subscriber
    {
        return $this->subscriber;
    }

    /**
     * @param Subscriber $subscriber
     * @return Media
     */
    public function setSubscriber(?Subscriber $subscriber): Media
    {
        $this->subscriber = $subscriber;
        return $this;
    }

    /**
     * @return Subscriber
     */
    public function getPublication(): Publication
    {
        return $this->publication;
    }

    /**
     * @param Publication $publication
     * @return Media
     */
    public function setPublication(Publication $publication): Media
    {
        $this->publication = $publication;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalFileName(): string
    {
        return $this->originalFileName;
    }

    /**
     * @param string $originalFileName
     * @return Media
     */
    public function setOriginalFileName(string $originalFileName): Media
    {
        $this->originalFileName = $originalFileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getRelativePath(): string
    {
        return $this->relativePath;
    }

    /**
     * @param string $relativePath
     * @return Media
     */
    public function setRelativePath(string $relativePath): Media
    {
        $this->relativePath = $relativePath;
        return $this;
    }
}