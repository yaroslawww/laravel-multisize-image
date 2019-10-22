<?php

namespace Gcsc\LaravelMultisizeImage\ImageSizes;

class ImageSize500x500 extends AbstractImageSize
{
    /**
     * ImageSize500x500 constructor.
     */
    public function __construct()
    {
        parent::__construct(500, 500, false);
    }

    public static function getSlug()
    {
        return '500x500';
    }
}
