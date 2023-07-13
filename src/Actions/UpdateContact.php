<?php

namespace Ally\Actions;

use Illuminate\Support\Facades\Validator;
use Ally\Ally;
use Ally\Contact;
use Ally\Contracts\UpdatesContacts;
use Ally\Events\ContactUpdated;
use Ally\Events\UpdatingContact;

class UpdateContact implements UpdatesContacts
{
    /**
     * Update a contact.
     *
     * @param  mixed  $user
     * @param  \Ally\Contact  $contact
     * @param  array  $data
     * @return \Ally\Contact
     */
    public function __invoke($user, Contact $contact, array $data)
    {
        event(new UpdatingContact(user: $user, contact: $contact, data: $data));

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'meta' => 'nullable|array',
        ])->validateWithBag('updateContact');

        $contact->update(collect($data)->only([
            'name',
            'type',
            'meta',
        ])->toArray());

        $contact->refresh();

        event(new ContactUpdated(contact: $contact));

        return $contact->refresh();
    }
}
