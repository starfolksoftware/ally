<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Ally\Actions\CreateContact;
use Ally\Actions\DeleteContact;
use Ally\Actions\UpdateContact;
use Ally\Ally;

class AllyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Ally::createContactsUsing(CreateContact::class);

        Ally::updateContactsUsing(UpdateContact::class);

        Ally::deleteContactsUsing(DeleteContact::class);
    }
}