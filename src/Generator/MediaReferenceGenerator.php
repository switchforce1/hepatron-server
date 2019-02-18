<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 17/02/2019
 * Time: 00:39
 */

namespace App\Generator;


use App\Entity\Admin\Media;
use App\Helper\Generic\StringHelper;

class MediaReferenceGenerator extends AbstractReferenceGenerator
{
    /**
     * @var StringHelper
     */
    protected $stringHelper;

    /**
     * MediaReferenceGenerator constructor.
     * @param StringHelper $stringHelper
     */
    public function __construct(StringHelper $stringHelper)
    {
        $this->stringHelper = $stringHelper;
    }


    /**
     * @return string
     */
    protected function getEntityName()
    {
        return Media::class;
    }

    /**
     * @return string
     */
    protected function getReferencePrefix()
    {
        $dateString = (new \DateTime('now'))->format("Ymd_His");
        return "MEDIA".$dateString;
    }

    /**
     *
     */
    public function getReference()
    {
        $uniqueString = $this->stringHelper->generateRandomString(12);
        return $this->getReferencePrefix().$uniqueString;
    }
}