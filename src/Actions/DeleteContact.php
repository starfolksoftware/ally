<?php

namespace Ally\Actions;

use Ally\Contracts\DeletesContacts;
use Ally\Events\ContactDeleted;
use Ally\Events\DeletingContact;

class DeleteContact implements DeletesContacts
{
    /**
     * Delete a contact.
     *
     * @param  mixed  $user
     * @param  mixed  $contact
     * @return void
     */
    public function __invoke($user, $contact)
    {
        event(new DeletingContact(user: $user, contact: $contact));

        $contact->delete();

        event(new ContactDeleted(user: $user, contact: $contact));
    }
}
