<?php

namespace StarfolkSoftware\Ally\Contracts;

use StarfolkSoftware\Ally\Contact;

interface DeletesContacts
{
    /**
     * Delete an existing contact.
     *
     * @param  mixed  $user
     * @param  \StarfolkSoftware\Ally\Contact  $contact
     * @return void
     */
    public function __invoke($user, Contact $contact);
}
