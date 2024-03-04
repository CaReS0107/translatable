<?php

use Illuminate\Support\Facades\File;
use Translatable\Translatable\Commands\TranslatableCommand;

it('can found translatable files in resources', function () {
    config()->set('translatable.translation_files_path', $path = resource_path('lang'));
    config()->set('translatable.available_countries', ['en']);

    File::ensureDirectoryExists($path);

    if (! File::exists($path)) {
        File::makeDirectory($path, 0755, true);
    }

    File::put("{$path}/en.json", json_encode(['Testing' => '']));

    expect(app(TranslatableCommand::class)
        ->getTranslatableFiles())
        ->toContain("{$path}/en.json");

    File::delete("{$path}/en.json");
    File::deleteDirectory($path);
});
