<?php

namespace Ally\Actions;

use Illuminate\Support\Facades\Validator;
use Ally\Ally;
use Ally\Contracts\CreatesContacts;
use Ally\Events\ContactCreated;
use Ally\Events\CreatingContact;

class CreateContact implements CreatesContacts
{
    /**
     * Create a new tax.
     *
     * @param  mixed  $user
     * @param  array  $data
     * @param  mixed  $teamId
     * @return \Ally\Contact
     */
    public function __invoke($user, array $data, $teamId = null)
    {
        event(new CreatingContact(user: $user, data: $data));

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'meta' => 'nullable|array',
        ])->validateWithBag('createContact');

        $fields = collect($data)->only([
            'name',
            'type',
            'meta',
        ])->toArray();

        $contact = Ally::$supportsTeams ?
            Ally::findTeamByIdOrFail($teamId)->contacts()->create($fields) :
            Ally::newContactModel()->create($fields);

        event(new ContactCreated(contact: $contact));

        return $contact;
    }
}
