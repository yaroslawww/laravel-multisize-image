# Crop multiple sizes image while downloading

## Installation

You can install the package via composer:

```bash
composer require yaroslawww/laravel-multisize-image
```
## Usage

```php
 /** @var SavedImageData $result */
$result = (new AvatarManager($user))->replaceOrSave($request->new_avatar);
if(!empty($result->getSizes())) {
    $user->avatar = $result->getName();
    $user->save();
}
```

### Testing

``` bash
composer test
```

### Security

If you discover any security related issues, please email yaroslav.georgitsa@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
