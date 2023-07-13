# Introduction

Manage contacts(e.g customers, suppliers, vendors etc) in your laravel applications.

## Installation

You can install the package via composer:

```bash
composer require starfolksoftware/ally
php artisan Ally:install
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="ally-config"
```

## Configuration

This is the contents of the published config file:

```php
return [
    'middleware' => ['web'],

    'redirects' => [
        'store' => null,
        'update' => null,
        'destroy' => '/',
    ],
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="ally-views"
```

## Usage

```php
<?php

namespace App\Models;

use App\Abstracts\Model;
use Ally\HasContacts;

class Product extends Model
{
    use HasContacts;
}

```

To enable team support:

```php
// this should be in a service provider
/**
 * Bootstrap any application services.
 *
 * @return void
 */
public function boot()
{
    Ally::supportsTeams();
}
```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ally\TeamHasCategories;

class Team extends JetstreamTeam
{
    ...
    use TeamHasCategories;
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/starfolksoftware/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Faruk Nasir](https://github.com/frknasir)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
