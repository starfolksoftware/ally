<?php

namespace App\Models;

use Ally\Contact as AllyContact;
use Ally\Events\ContactCreated;
use Ally\Events\ContactDeleted;
use Ally\Events\ContactUpdated;

class Contact extends AllyContact
{
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