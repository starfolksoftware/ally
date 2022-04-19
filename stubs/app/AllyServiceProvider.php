<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use StarfolkSoftware\Ally\Actions\CreateContact;
use StarfolkSoftware\Ally\Actions\DeleteContact;
use StarfolkSoftware\Ally\Actions\UpdateContact;
use StarfolkSoftware\Ally\Ally;

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