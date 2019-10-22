<?php

namespace Gcsc\LaravelMultisizeImage\ImageSizes;

class ImageSize1500x1500 extends AbstractImageSize
{
    /**
     * ImageSize1500x1500 constructor.
     */
    public function __construct()
    {
        parent::__construct(1500, 1500, false);
    }

    public static function getSlug()
    {
        return '1500x1500';
    }
}
