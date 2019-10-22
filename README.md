# Crop multiple sizes image while downloading

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/yaroslawww/laravel-multisize-image.svg?branch=master)](https://travis-ci.org/yaroslawww/laravel-multisize-image) 
[![StyleCI](https://github.styleci.io/repos/195302588/shield?branch=master&style=flat-square)](https://github.styleci.io/repos/216840241)
[![Quality Score](https://img.shields.io/scrutinizer/g/yaroslawww/laravel-multisize-image.svg?b=master)](https://scrutinizer-ci.com/g/yaroslawww/laravel-multisize-image/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/yaroslawww/laravel-multisize-image/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/yaroslawww/laravel-multisize-image/?branch=master)
[![PHP Version](https://img.shields.io/travis/php-v/yaroslawww/laravel-multisize-image.svg?style=flat-square)](https://packagist.org/packages/yaroslawww/laravel-multisize-image)
[![Packagist Version](https://img.shields.io/packagist/v/yaroslawww/laravel-multisize-image.svg)](https://packagist.org/packages/yaroslawww/laravel-multisize-image)
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
