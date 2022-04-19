<?php

namespace StarfolkSoftware\Ally\Actions;

use StarfolkSoftware\Ally\Ally;
use StarfolkSoftware\Ally\Contact;
use StarfolkSoftware\Ally\Contracts\DeletesContacts;

class DeleteContact implements DeletesContacts
{
    /**
     * Delete a contact.
     *
     * @param  mixed  $user
     * @param  \StarfolkSoftware\Ally\Contact  $contact
     * @return void
     */
    public function __invoke($user, Contact $contact)
    {
        if (is_callable(Ally::$validateContactDeletion)) {
            call_user_func(
                Ally::$validateContactUpdate,
                $user,
                $contact
            );
        }

        $contact->delete();
    }
}
