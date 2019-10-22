<?php

namespace Gcsc\LaravelMultisizeImage\ImageManagers;

use Gcsc\LaravelMultisizeImage\Exceptions\NotValidImageSizeException;
use Gcsc\LaravelMultisizeImage\ImageSizes\ImageSizeInterface;
use Gcsc\LaravelMultisizeImage\SavedImageData;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

abstract class AbstractImageManager
{
    protected static function defaultImageSize()
    {
        $sizes = static::imageSizes();
        $size = end($sizes);
        reset($sizes);

        return $size;
    }

    /**
     * @return string
     */
    abstract protected function oldImage();

    /**
     * @return  array
     */
    abstract public static function imageSizes();

    public static function getPathPrefix()
    {
        return '';
    }

    /**
     * @param ImageSizeInterface $image_size
     * @param $name
     * @return string
     */
    public static function getPathForImageSize(ImageSizeInterface $image_size, $name)
    {
        return static::getPathPrefix() . '/' . $image_size->getSlug() . '/' . $name;
    }

    /**
     * @param UploadedFile|string $image
     * @param $name
     * @return SavedImageData
     * @throws NotValidImageSizeException
     */
    public function save($image, $name = null)
    {
        if (is_string($image)) {
            @list($type, $image) = explode(';', $image);
            @list(, $image) = explode(',', $image);
            if (!$name) {
                $name = md5(uniqid(mt_rand(), true)) . '.' . \Illuminate\Http\Testing\MimeType::search($type);
            }
        }

        if (!$name) {
            $name = md5(uniqid(mt_rand(), true)) . '.' . $image->getClientOriginalExtension();
        }

        $imageData = new SavedImageData($name);
        foreach ($this->imageSizes() as $image_size_class) {
            $image_size = new $image_size_class();
            if (!($image_size instanceof ImageSizeInterface)) {
                throw new NotValidImageSizeException('image size except implement ImageSizeInterface');
            }

            /** @var \Intervention\Image\Image $img */
            $img = Image::make($image);

            $img->resize(
                $image_size->getWidth(),
                $image_size->getHeight(),
                function (Constraint $constraint) use ($image_size) {
                    if (!$image_size->getForceCrop()) {
                        $constraint->aspectRatio();
                    }
                    $constraint->upsize();
                }
            );

            $is_saved = Storage::disk($image_size->getDisk())->put($this->getPathForImageSize($image_size, $name), (string)$img->encode());

            if ($is_saved) {
                $imageData->addSize(
                    $image_size::getSlug(),
                    [
                        'size' => $img->width() . '/' . $img->height(),
                        'width' => $img->width(),
                        'height' => $img->height(),
                    ]
                );
            } else {
                $imageData->addError(
                    $image_size::getSlug()
                );
            }
        }

        return $imageData;
    }

    /**
     * @param null $name
     * @return bool
     * @throws NotValidImageSizeException
     */
    public function delete($name = null)
    {
        if (is_null($name)) {
            $name = $this->oldImage();
        }

        if ($name) {
            return static::destroy($name);
        }

        return false;
    }

    /**
     * @param $name
     * @return bool
     * @throws NotValidImageSizeException
     */
    public static function destroy($name)
    {
        $is_deleted_statuses = [];
        foreach (static::imageSizes() as $image_size_class) {
            $image_size = new $image_size_class();
            if (!($image_size instanceof ImageSizeInterface)) {
                throw new NotValidImageSizeException('image size except implement ImageSizeInterface');
            }
            $is_deleted = Storage::disk($image_size->getDisk())->delete(static::getPathForImageSize($image_size, $name));
            if ($is_deleted) {
                $is_deleted_statuses[] = $image_size_class;
            }
        }

        if (count($is_deleted_statuses) === count(static::imageSizes())) {
            return true;
        }


        //TODO:: send notification to admin;

        return false;
    }

    /**
     * @param UploadedFile|string $image
     * @param $old_name
     * @param $new_name
     * @return array|null
     * @throws NotValidImageSizeException
     */
    public function replace($image, $old_name, $new_name = null)
    {

        $this->delete($old_name);

        return $this->save($image, $new_name);

    }

    /**
     * @param UploadedFile|string $image
     * @param $new_name
     * @return array|null
     * @throws NotValidImageSizeException
     */
    public function replaceOrSave($image, $new_name = null)
    {
        if ($this->oldImage()) {
            return $this->replace($image, $this->oldImage(), $new_name);
        }

        return $this->save($image, $new_name);
    }

    public static function urls($name)
    {
        $urls = [];
        foreach (static::imageSizes() as $image_size_class) {
            $image_size = new $image_size_class();
            if (!($image_size instanceof ImageSizeInterface)) {
                throw new NotValidImageSizeException('image size except implement ImageSizeInterface');
            }

            $urls[$image_size->getSlug()] = (string)Storage::disk($image_size->getDisk())->url(static::getPathForImageSize($image_size, $name));
        }

        return $urls;
    }

    public static function url($name)
    {
        $size = static::defaultImageSize();
        $image_size = new $size();
        if (!($image_size instanceof ImageSizeInterface)) {
            throw new NotValidImageSizeException('image size except implement ImageSizeInterface');
        }

        return (string)Storage::disk($image_size->getDisk())->url(self::getPathForImageSize($image_size, $name));
    }

}
