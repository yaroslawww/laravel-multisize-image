<?php

namespace Gcsc\LaravelMultisizeImage\ImageSizes;

class ImageSize300x300 extends AbstractImageSize
{
    /**
     * ImageSize300x300 constructor.
     */
    public function __construct()
    {
        parent::__construct(300, 300, false);
    }

    public static function getSlug()
    {
        return '300x300';
    }
}
