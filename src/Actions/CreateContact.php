<?php

namespace Ally\Actions;

use Ally\Ally;
use Ally\Contracts\CreatesContacts;
use Ally\Events\ContactCreated;
use Ally\Events\CreatingContact;
use Illuminate\Support\Facades\Validator;

class CreateContact implements CreatesContacts
{
    /**
     * Create a new tax.
     *
     * @param  mixed  $user
     * @param  array  $data
     * @param  mixed  $teamId
     * @return mixed
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

        event(new ContactCreated(user: $user, contact: $contact, data: $data));

        return $contact;
    }
}
