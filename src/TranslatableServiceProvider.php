<?php

namespace Translatable\Translatable;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Translatable\Translatable\Commands\TranslatableCommand;

class TranslatableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('translatable')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(TranslatableCommand::class);
    }
}
