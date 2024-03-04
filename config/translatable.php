<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Available Countries
    |--------------------------------------------------------------------------
    |
    | This array should list the ISO 3166-1 alpha-2 codes of the countries for which
    | translation files are expected to be present in the project. Each code corresponds
    | to a translation file named after the country code, e.g., 'en' for 'en.json'.
    | These codes help the application identify which translations to load and manage.
    |
    */
    'available_countries' => [
        'en', 'nl',
    ],

    /*
    |--------------------------------------------------------------------------
    | Translation Files Path
    |--------------------------------------------------------------------------
    |
    | Specify the root path where the translation files are located. The system
    | will look for translation files (e.g., 'en.json', 'nl.json') starting from this path.
    | By default, this is set to the base path of the Laravel application, but it can
    | be adjusted to point to specific directories where translation files are stored.
    |
    */
    'translation_files_path' => base_path(),

    /*
    |--------------------------------------------------------------------------
    | Exclude Paths
    |--------------------------------------------------------------------------
    |
    | List of paths to be excluded when searching for translation files. This is useful
    | for preventing the search operation from scanning directories that are not relevant
    | to the application's translations, such as vendor dependencies or node modules.
    | Paths should be relative to the 'translation_files_path' or absolute paths.
    |
    */
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
