<?php

namespace Ally\Tests\Mocks;

use Ally\Contact as AllyContact;
use Ally\Events\ContactCreated;
use Ally\Events\ContactDeleted;
use Ally\Events\ContactUpdated;

class Contact extends AllyContact
{
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ContactFactory::new();
    }

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ContactCreated::class,
        'updated' => ContactUpdated::class,
        'deleted' => ContactDeleted::class,
    ];
}