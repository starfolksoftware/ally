<?php

namespace StarfolkSoftware\Ally\Contracts;

use StarfolkSoftware\Ally\Contact;

interface UpdatesContacts
{
    /**
     * Update an existing contact.
     *
     * @param  mixed  $user
     * @param  \StarfolkSoftware\Ally\Contact  $contact
     * @param  array  $data
     * @return \StarfolkSoftware\Ally\Contact
     */
    public function __invoke($user, Contact $contact, array $data);
}