# System

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

Đây là hệ thống được cài đặt sẵn trang quản trị admin lte trong đó bao gồm quản lý vai trò, thành viên và hệ thống(nơi để config các từ khóa...)
Hệ thống có sử dụng 5 package và đã bao gồm ckfinder + ckeditor
1. ckfinder/ckfinder-laravel-package
2. jeroennoten/Laravel-AdminLTE
3. spatie/laravel-permission
4. laravel/ui
5. kalnoy/nestedset
## Cài đặt

Thông qua Composer

``` bash
$ composer require quyenvkbn/system
```

Xuất bản các file cần thiết
``` bash
config/system.php
config/ckfinder.php
config/adminlte.php
public/js/ckeditor
public/js/system.js
database/seeds/UserDatabaseSeeder.php
database/seeds/SeedFakeAdminUserTableSeeder.php
resources/views/home.balde.php
resources/lang/vendor/quyenvkbn

$ php artisan vendor:publish --tag=system.default --force
```

Cài đặt trang login, register...

``` bash
$ php artisan ui bootstrap --auth
```

Cài đặt các thư viện script cần thiết

``` bash
$ npm install
```

Biên dịch các thư viên cần thiết vào file public/js/app.css và public/css/app.js

``` bash
$ npm run dev
```

Cài đặt adminlte băng lệnh sau

``` bash
$ php artisan adminlte:install
```

Bạn cần tải CK Downloader

``` bash
$ php artisan ckfinder:download
```

Xuất bản cấu hình và tài sản của trình kết nối CK Downloader

``` bash
// --tag=ckfinder-config
$ php artisan vendor:publish --tag=ckfinder-assets
```

Xuất bản cấu hình, tài sản và chế độ xem của ckfinder

``` bash
$ php artisan vendor:publish --tag=ckfinder
```

Theo mặc định Ckfinder sử dụng cơ chế bảo vệ CSRF dựa vào cookie, nên bạn cần thêm tên cookie ckCsrfToken vào thuộc tính $except của app/Http/Middleware/EncryptCookies.php

``` bash

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

Bạn cũng nên vô hiệu hóa cơ chế bảo vệ CSRF của Laravel cho đường dẫn của CK Downloader. Điều này có thể được thực hiện bằng cách thêm ckfinder/* vào thuộc tính $except của app/Http/Middleware/VerifyCsrfToken.php

``` bash
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

Xuất bản file config/permission.php

``` bash
$ php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Thêm các bảng vào cơ sở dữ liệu

``` bash
$ php artisan migrate
```

## Contributing

Thêm nội dung sau vào model App/User

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

Thêm nội dung sau vào App\Http\Controllers\Auth\LoginController

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

Load lại tất cả các thư viện trong composer để sử dụng 

``` bash
$ composer dump-autoload
```

Thêm dữ liệu mẫu vào cơ sở dữ liệu

``` bash
$ php artisan db:seed
OR
$ php artisan db:seed --class=UserDatabaseSeeder
```

Đăng ký thêm các alias middleware trong file App/Http/Kernel

``` bash
protected $routeMiddleware = [
    ... 
    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
]
```

Bạn có biến $site_settings trong View blade khi router sử dụng Middleware site_settings đây là danh sách các config của hệ thống

## Contributing

Please see the [changelog](changelog.md) for more information on what has changed recently.

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
