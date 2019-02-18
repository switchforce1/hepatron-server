<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 05/08/2018
 * Time: 00:33
 */

namespace App\Entity\Admin;

use App\Entity\EntityInterface;
use App\Entity\Security\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseFile
 * @package App\Entity\Admin
 * @ORM\MappedSuperclass
 */
class BaseFile implements EntityInterface
{

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", name="description", nullable=true)
     */
    protected $description;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $creationDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updateDate;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $filePath;

    /**
     * @var array
     * @ORM\Column(type="array", nullable=true)
     */
    protected $detail;

    /**
     * BaseFile constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return BaseFile
     */
    public function setName(string $name): BaseFile
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return BaseFile
     */
    public function setDescription(string $description): BaseFile
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return BaseFile
     */
    public function setCreationDate(\DateTime $creationDate): BaseFile
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }

    /**
     * @param \DateTime $updateDate
     * @return BaseFile
     */
    public function setUpdateDate(\DateTime $updateDate): BaseFile
    {
        $this->updateDate = $updateDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     * @return BaseFile
     */
    public function setFilePath(string $filePath): BaseFile
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * @return array
     */
    public function getDetail(): array
    {
        return $this->detail;
    }

    /**
     * @param array $detail
     * @return BaseFile
     */
    public function setDetail(array $detail): BaseFile
    {
        $this->detail = $detail;
        return $this;
    }


}