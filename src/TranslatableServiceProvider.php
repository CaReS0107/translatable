<?php

namespace Translatable\Translatable;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Translatable\Translatable\Commands\TranslatableCommand;

class TranslatableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('translatable')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_translatable_table')
            ->hasCommand(TranslatableCommand::class);
    }
}
