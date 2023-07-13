<?php

namespace Ally\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class ContactEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param  mixed  $user
     * @param  mixed  $contact
     * @param  array  $data
     * @return void
     */
    public function __construct(
        public $user = null,
        public $contact = null,
        public $data = []
    ) {
    }
}