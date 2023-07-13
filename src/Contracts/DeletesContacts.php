<?php

namespace Ally\Contracts;

use Ally\Contact;

interface DeletesContacts
{
    /**
     * Delete an existing contact.
     *
     * @param  mixed  $user
     * @param  \Ally\Contact  $contact
     * @return void
     */
    public function __invoke($user, Contact $contact);
}
