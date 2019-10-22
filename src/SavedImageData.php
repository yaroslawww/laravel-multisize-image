<?php

namespace Gcsc\LaravelMultisizeImage;

class SavedImageData
{
    protected $name;

    protected $sizes = [];

    protected $errors = [];

    /**
     * SavedImageData constructor.
     * @param $name
     * @param array $sizes
     */
    public function __construct(string $name, array $sizes = [])
    {
        $this->name = $name;
        $this->sizes = $sizes;
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
     * @return SavedImageData
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getSizes(): array
    {
        return $this->sizes;
    }

    /**
     * @param array $sizes
     * @return SavedImageData
     */
    public function setSizes(array $sizes): self
    {
        $this->sizes = $sizes;

        return $this;
    }

    /**
     * @param string $key
     * @param array $size
     * @return SavedImageData
     */
    public function addSize(string $key, array $size): self
    {
        $this->sizes[$key] = $size;

        return $this;
    }

    /**
     * @param string $error
     * @return SavedImageData
     */
    public function addError(string $error): self
    {
        $this->errors[] = $error;

        return $this;
    }
}
