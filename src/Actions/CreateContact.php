<?php

namespace StarfolkSoftware\Ally\Actions;

use Illuminate\Support\Facades\Validator;
use StarfolkSoftware\Ally\Ally;
use StarfolkSoftware\Ally\Contracts\CreatesContacts;

class CreateContact implements CreatesContacts
{
    /**
     * Create a new tax.
     *
     * @param  mixed  $user
     * @param  array  $data
     * @param  mixed  $teamId
     * @return \StarfolkSoftware\Ally\Contact
     */
    public function __invoke($user, array $data, $teamId = null)
    {
        if (is_callable(Ally::$validateContactCreation)) {
            call_user_func(
                Ally::$validateContactCreation,
                $user,
                $data
            );
        }

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'meta' => 'nullable|array',
            'meta.*.label' => 'required|string|max:255',
            'meta.*.value' => 'required|string|max:255',
        ])->validateWithBag('createContact');

        $fields = collect($data)->only([
            'name',
            'type',
            'meta',
        ])->toArray();

        return Ally::$supportsTeams ?
            Ally::findTeamByIdOrFail($teamId)->contacts()->create($fields) :
            Ally::newContactModel()->create($fields);
    }
}
