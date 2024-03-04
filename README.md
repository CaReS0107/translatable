# This is Translatable

The Translatable package is a powerful tool designed for Laravel applications that require dynamic translation management across multiple languages. It automates the process of scanning your Laravel project for translation keys and ensures that each key is properly defined in the corresponding JSON translation files for every language specified in your configuration. With Translatable, you can easily maintain and update your application's translations, making it an essential package for developers aiming to provide a multilingual user experience.

Key features include:

Automatic Scanning: Scours PHP files throughout your Laravel application to identify all instances of translation keys.
Dynamic Translation Management: Automatically updates JSON translation files for each configured language, ensuring that no translation key is left undefined.
Configurable and Extensible: Offers flexible configuration options, including customizable paths for scanning and exclusion rules to skip directories like vendor or node_modules.
Streamlined Localization Workflow: Simplifies the localization process, making it easier to manage translations across large and complex applications.
Whether you're building a small project or a large enterprise application, Translatable helps keep your translations organized and in sync, facilitating a smoother development process and a better user experience for multi-language applications.

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
