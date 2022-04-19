<?php

namespace StarfolkSoftware\Ally;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use StarfolkSoftware\Ally\Commands\AllyCommand;

class AllyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ally')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_ally_table')
            ->hasCommand(AllyCommand::class);
    }
}
