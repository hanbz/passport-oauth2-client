
# Laravel passport client

<p>
<a href="https://packagist.org/packages/hanbz/passport-client"><img src="https://img.shields.io/packagist/dt/hanbz/passport-client" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/hanbz/passport-client"><img src="https://img.shields.io/packagist/v/hanbz/passport-client" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/hanbz/passport-client"><img src="https://img.shields.io/packagist/l/hanbz/passport-client" alt="License"></a>
</p>

## Introduction

Fork from Laravel Socialite to build a Laravel passport client library to OAuth2.0 authentication with [Laravel port](https://github.com/laravel/passport).

## Install
```
$ composer require hanbz/passport-client
```

add the config at .env
```
CLIENT_ID=oauth_client
CLIENT_SECRET=oauth_secert
REDIRECT=your_callback_url
OAUTH_DOMAIN=your_oauth_server
```

add this section at config/service.php
```
    'passport' => [
        'client_id' => env('CLIENT_ID'),
        'client_secret' => env('CLIENT_SECRET'),
        'redirect' => env('REDIRECT'),
        'domain' => env('OAUTH_DOMAIN')
    ]
```

## Usage

Use the package by Facades name PassportClient. The driver name is passport. It includes two functions redirect and user.

The redirect function will redirect user to the oauth server. 

##### web.php
```php
use App\Http\Controllers\Auth\OAuthController;
use hanbz\PassportClient\Facades\PassportClient;

Route::get('oauth/login', fn() => PassportClient::driver('passport')->redirect())->name('oauth.login');
Route::get('oauth/callback', [OAuthController::class, 'OAuthCallback']);
```
## 

The user function will return the user info.

##### AuthController.php
```php
use App\Models\User;
use hanbz\PassportClient\Facades\PassportClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

    public function OAuthCallback()
    {
        $oauth_user = PassportClient::driver('passport')->user();

        $user = User::where('email', $oauth_user->getEmail())->first();

        if (is_null($user)) {
            $name = $oauth_user->getName();
            $email = $oauth_user->getEmail();
            $password = Str::random(8);
            $user = User::create(compact('name', 'email', 'password'));
        }

        Auth::login($user);

        return redirect()->intended('dashboard');
    }
```  

## Contributing

Thank you for considering contributing to Laravel passport client!

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

Laravel passport client is open-sourced software licensed under the [MIT license](LICENSE.md).
