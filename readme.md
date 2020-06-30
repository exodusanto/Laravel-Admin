# Laravel Administrator (New Version)

Administrator is an administrative interface builder for [Laravel](http://laravel.com). With Administrator you can visually manage your Eloquent models and their relations, and also create stand-alone settings pages for storing site data and performing site tasks.

- **Author:** Jan Hartigan
- **Website:** [http://frozennode.com](http://administrator.frozennode.com/)
- **Version:** 5.0.11

New Version

- **Author:** Antonio Dal Sie
- **Website:** [http://antoniodalsie.com](http://antoniodalsie.com/)
- **Version:** 5.4

[![Build Status](https://travis-ci.org/exodusanto/Laravel-Admin.svg?branch=master)](https://travis-ci.org/exodusanto/Laravel-Admin)

<img src="https://raw.github.com/FrozenNode/Laravel-Administrator/master/examples/images/overview.jpg" />

## Composer

To install Administrator as a Composer package to be used with Laravel 5.8, simply run:

```sh
composer require "exodusanto/administrator: 5.8.*"
```

To install Administrator as a Composer package to be used with Laravel 5.7, simply run:

```sh
composer require "exodusanto/administrator: 5.7.*"
```

Once it's installed, you can register the service provider in `config/app.php` in the `providers` array:

```php
'providers' => [
    'Frozennode\Administrator\AdministratorServiceProvider',
]
```

Then publish Administrator's assets with `php artisan vendor:publish`. This will add the file `config/administrator.php`. This [config file](http://administrator.frozennode.com/docs/configuration) is the primary way you interact with Administrator. This command will also publish all of the assets, views, and translation files.

### Laravel 4

If you want to use Administrator with Laravel 4, you need to resolve to Administrator 4:

```json
"exodusanto/administrator": "4.*"
```

Then publish the config file with `php artisan config:publish frozennode/administrator`. This will add the file `app/config/packages/frozennode/administrator/administrator.php`.

Then finally you need to publish the package's assets with the `php artisan asset:publish frozennode/administrator` command.

### Laravel 3

Since Administrator has switched over to Composer, you can no longer use `php artisan bundle:install administrator` or `php artisan bundle:upgrade administrator`. If you want to use Administrator with Laravel 3, you must switch to the [3.3.2 branch](https://github.com/FrozenNode/Laravel-Administrator/tree/3.3.2), download it, and add it in the `/bundles/administrator` directory and add this to your bundles.php file:

```php
'administrator' => array(
    'handles' => 'admin', //this determines what URI this bundle will use
    'auto' => true,
),
```

## Documentation

The complete docs for Administrator can be found at http://administrator.frozennode.com. You can also find the docs in the `/src/docs` directory.


## Copyright and License
Administrator was written by Jan Hartigan of Frozen Node for the Laravel framework.
Administrator is released under the MIT License. See the LICENSE file for details.


## Recent Changelog

### 7.0.0
- Support: Laravel 7.0

### 6.0.0
- Support: Laravel 6.0

### 5.8.1
- Fix: Relationships BelongsTo (#30)

### 5.8.0
- Support: Laravel 5.8

### 5.7.0
- Support: Laravel 5.7

### 5.6.5
- Added: Allow custom routes name (#23)

### 5.6.5
- Support: PHP 7.2 (#22)

### 5.6.3
- Added: Cloud upload options

### 5.6.0
- Support: Laravel 5.6
