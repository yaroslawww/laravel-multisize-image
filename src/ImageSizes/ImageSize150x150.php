<?php

namespace Gcsc\LaravelMultisizeImage\ImageSizes;

class ImageSize150x150 extends AbstractImageSize
{
    /**
     * ImageSize150x150 constructor.
     */
    public function __construct()
    {
        parent::__construct(150, 150, false);
    }

    public static function getSlug()
    {
        return '150x150';
    }
}
