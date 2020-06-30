# System

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require quyenvkbn/system
```

## Usage

Publishes all

## Installation

Via Composer

``` bash
$ php artisan vendor:publish --tag=system.default --force
```

## Usage

## Change log

Generate login / registration scaffolding...

## Testing

``` bash
$ php artisan ui bootstrap --auth
```

## Contributing

## Testing

``` bash
$ npm install
```

## Contributing

## Testing

``` bash
$ npm run dev
```

## Contributing



## Testing

``` bash
$ php artisan adminlte:install
```

## Contributing

After installing the Laravel package you need to download CKFinder code. It is not shipped with the package due to different license terms. To install it, run the following artisan command:

## Testing

``` bash
$ php artisan ckfinder:download
```

## Contributing

Publish the CKFinder connector configuration and assets.

## Testing

``` bash
// --tag=ckfinder-config
$ php artisan vendor:publish --tag=ckfinder-assets
```

## Contributing

Finally, you can publish package's configuration, assets and views using only one command.

## Testing

``` bash
// --tag=ckfinder-config
$ php artisan vendor:publish --tag=ckfinder
```

## Contributing

## Testing

``` bash
// app/Http/Middleware/EncryptCookies.php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'ckCsrfToken',
        // ...
    ];
}
```

## Contributing


## Testing

``` bash
// app/Http/Middleware/VerifyCsrfToken.php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'ckfinder/*',
        // ...
    ];
}
```

## Contributing

The new middleware class will appear in app/Http/Middleware/CustomCKFinderAuth.php. Change the authentication option in config/ckfinder.php:

## Testing

``` bash
$config['authentication'] = '\App\Http\Middleware\CustomCKFinderAuth';
```

## Contributing

This package publishes a config/permission.php file. If you already have a file by that name, you must rename or remove it.

## Testing

``` bash
$ php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

## Contributing

create database

## Testing

``` bash
$ php artisan migrate
```

## Contributing

App/User

## Testing

``` bash
...
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
class User{
    ...
    use HasRoles;
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}

```

## Contributing

App\Http\Controllers\Auth\LoginController

## Testing

``` bash
...
use Illuminate\Http\Request;

class LoginController extends Controller
{
    ...
    protected function authenticated(Request $request, $user)
    {
        UpdateCKFinderUserRole($user);
    }
}

```

## Contributing

dump-autoload

## Testing

``` bash
$ composer dump-autoload
```

## Contributing

create data in database

## Testing

``` bash
$ php artisan db:seed
OR
$ php artisan db:seed --class=UserDatabaseSeeder
```

## Contributing

App/Http/Kernel

## Testing

``` bash
protected $routeMiddleware = [
    ...
    'language' => \App\Http\Middleware\LanguageSwitcher::class,   
    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
]
```

## Contributing

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [author name][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/quyenvkbn/system.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/quyenvkbn/system.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/quyenvkbn/system/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/quyenvkbn/system
[link-downloads]: https://packagist.org/packages/quyenvkbn/system
[link-travis]: https://travis-ci.org/quyenvkbn/system
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/quyenvkbn
[link-contributors]: ../../contributors
