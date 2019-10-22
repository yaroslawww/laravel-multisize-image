<?php

namespace Gcsc\LaravelMultisizeImage\ImageSizes;

abstract class AbstractImageSize implements ImageSizeInterface
{
    protected $disk = 'local';
    protected $width;
    protected $height;
    protected $force_crop;

    /**
     * AbstractImageSize constructor.
     * @param $width
     * @param $height
     * @param $force_crop
     */
    public function __construct($width, $height, $force_crop)
    {
        $this->width = $width;
        $this->height = $height;
        $this->force_crop = $force_crop;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getForceCrop()
    {
        return $this->force_crop;
    }

    public function getDisk()
    {
        return $this->disk;
    }

    /**
     * @param string $disk
     * @return AbstractImageSize
     */
    public function setDisk(string $disk): self
    {
        $this->disk = $disk;

        return $this;
    }
}
