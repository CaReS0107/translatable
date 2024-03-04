# This is my package translatable

## Installation

You can install the package via composer:

```bash
composer require cares0107/translatable
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="translatable-config"
```

This is the contents of the published config file:

```php
return [
'available_countries' => [
        'en', 'nl', 'ro', 'fr', 'ru', 'af', 'al', 'dz', 'as', 'ad', 'ao', 'ai', 'aq', 'ag', 'ar', 'am', 'aw', 'au', 'at', 'az',
        'bs', 'bh', 'bd', 'bb', 'by', 'be', 'bz', 'bj', 'bm', 'bt', 'bo', 'ba', 'bw', 'br', 'io', 'bn', 'bg', 'bf', 'bi', 'cv',
        'kh', 'cm', 'ca', 'ky', 'cf', 'td', 'cl', 'cn', 'cx', 'cc', 'co', 'km', 'cg', 'cd', 'ck', 'cr', 'ci', 'hr', 'cu', 'cw',
        'cy', 'cz', 'dk', 'dj', 'dm', 'do', 'ec', 'eg', 'sv', 'gq', 'er', 'ee', 'sz', 'et',
    ],
    'translation_files_path' => base_path(),
];
```

## Usage

```php
php artisan app:check-translations
```

## Testing

```bash
composer test
```

## Credits

- [Papuc Vasile](https://github.com/CaReS0107)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
