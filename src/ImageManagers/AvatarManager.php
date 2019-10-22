<?php

namespace Gcsc\LaravelMultisizeImage\ImageManagers;

use Illuminate\Database\Eloquent\Model;
use Gcsc\LaravelMultisizeImage\ImageSizes\ImageSize150x150;
use Gcsc\LaravelMultisizeImage\ImageSizes\ImageSize300x300;
use Gcsc\LaravelMultisizeImage\ImageSizes\ImageSize500x500;
use Gcsc\LaravelMultisizeImage\ImageSizes\ImageSize1500x1500;

class AvatarManager extends AbstractImageManager
{
    protected $model;

    /**
     * AvatarManager constructor.
     * @param Model $user
     */
    public function __construct(Model $user = null)
    {
        $this->model = $user;
    }

    protected function oldImage()
    {
        if ($this->model) {
            return $this->model->avatar;
        }
    }

    /**
     * @return array
     */
    public static function imageSizes()
    {
        return [
            ImageSize150x150::class,
            ImageSize300x300::class,
            ImageSize500x500::class,
            ImageSize1500x1500::class,
        ];
    }

    public static function getPathPrefix()
    {
        return 'avatars';
    }
}
