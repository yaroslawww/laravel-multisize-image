<?php

namespace Gcsc\LaravelMultisizeImage\ImageSizes;

interface ImageSizeInterface
{
    public function getWidth();

    public function getHeight();

    public function getForceCrop();

    public static function getSlug();

    public function getDisk();
}
