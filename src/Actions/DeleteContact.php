<?php

namespace Ally\Actions;

use Ally\Ally;
use Ally\Contact;
use Ally\Contracts\DeletesContacts;
use Ally\Events\ContactDeleted;
use Ally\Events\DeletingContact;

class DeleteContact implements DeletesContacts
{
    /**
     * Delete a contact.
     *
     * @param  mixed  $user
     * @param  \Ally\Contact  $contact
     * @return void
     */
    public function __invoke($user, Contact $contact)
    {
        event(new DeletingContact(user: $user, contact: $contact));

        $contact->delete();

        event(new ContactDeleted(contact: $contact));
    }
}
