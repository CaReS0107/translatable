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
            'en', 'nl',
        ],
    'translation_files_path' => base_path(),
    'exclude_paths' => [
        '/vendor/',
        '/node_modules/',
        '/frontend/',
        '/website/',
        '/database/',
        '/.git/',
        '/.github/',
    ],
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
