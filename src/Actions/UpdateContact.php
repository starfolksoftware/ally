<?php

namespace Ally\Actions;

use Ally\Contracts\UpdatesContacts;
use Ally\Events\ContactUpdated;
use Ally\Events\UpdatingContact;
use Illuminate\Support\Facades\Validator;

class UpdateContact implements UpdatesContacts
{
    /**
     * Update a contact.
     *
     * @param  mixed  $user
     * @param  mixed  $contact
     * @param  array  $data
     * @return mixed
     */
    public function __invoke($user, $contact, array $data)
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

        event(new ContactUpdated(user: $user, contact: $contact, data: $data));

        return $contact->refresh();
    }
}
