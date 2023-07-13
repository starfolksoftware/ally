<?php

namespace Ally\Contracts;

use Ally\Contact;

interface UpdatesContacts
{
    /**
     * Update an existing contact.
     *
     * @param  mixed  $user
     * @param  \Ally\Contact  $contact
     * @param  array  $data
     * @return \Ally\Contact
     */
    public function __invoke($user, Contact $contact, array $data);
}
