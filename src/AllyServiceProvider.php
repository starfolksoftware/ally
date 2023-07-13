<?php

namespace Ally;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ally\Actions\CreateContact;
use Ally\Actions\DeleteContact;
use Ally\Actions\UpdateContact;
use Ally\Commands\InstallCommand;

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
            ->hasCommand(InstallCommand::class);

        if (Ally::$runsMigrations) {
            $package->hasMigration('create_ally_table');
        }

        if (Ally::$registersRoutes) {
            $package->hasRoutes('web');
        }
    }

    public function packageRegistered()
    {
        Ally::createContactsUsing(CreateContact::class);

        Ally::updateContactsUsing(UpdateContact::class);

        Ally::deleteContactsUsing(DeleteContact::class);
    }
}
