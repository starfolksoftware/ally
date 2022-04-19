<?php

namespace StarfolkSoftware\Ally\Actions;

use Illuminate\Support\Facades\Validator;
use StarfolkSoftware\Ally\Ally;
use StarfolkSoftware\Ally\Contact;
use StarfolkSoftware\Ally\Contracts\UpdatesContacts;

class UpdateContact implements UpdatesContacts
{
    /**
     * Update a contact.
     *
     * @param  mixed  $user
     * @param  \StarfolkSoftware\Ally\Contact  $contact
     * @param  array  $data
     * @return \StarfolkSoftware\Ally\Contact
     */
    public function __invoke($user, Contact $contact, array $data)
    {
        if (is_callable(Ally::$validateContactCreation)) {
            call_user_func(
                Ally::$validateContactUpdate,
                $user,
                $contact,
                $data
            );
        }

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'meta' => 'nullable|array',
            'meta.*.label' => 'required|string|max:255',
            'meta.*.value' => 'required|string|max:255',
        ])->validateWithBag('updateContact');

        $contact->update(collect($data)->only([
            'name',
            'type',
            'meta',
        ])->toArray());

        return $contact->refresh();
    }
}
