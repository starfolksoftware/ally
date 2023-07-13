<?php

namespace Ally\Http\Controllers;

use Ally\Ally;
use Ally\Contracts\CreatesContacts;
use Ally\Contracts\DeletesContacts;
use Ally\Contracts\UpdatesContacts;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Ally\Contracts\CreatesContacts  $createsContacts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatesContacts $createsContacts)
    {
        $contact = $createsContacts(
            request()->user(),
            request()->all(),
            request('team_id'),
        );

        return request()->wantsJson() ? response()->json(['contact' => $contact]) : redirect()->to(
            request()->get('redirect', Ally::redirects('store', '/'))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  mixed  $contact
     * @param  \Ally\Contracts\UpdatesContacts  $updatesContacts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($contact, UpdatesContacts $updatesContacts)
    {
        $contact = Ally::newContactModel()->findOrFail($contact);

        $contact = $updatesContacts(
            request()->user(),
            $contact,
            request()->all()
        );

        return request()->wantsJson() ? response()->json(['contact' => $contact]) : redirect()->to(
            request()->get('redirect', Ally::redirects('update', '/'))
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $contact
     * @param  \Ally\Contracts\DeletesContacts  $deletesContacts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($contact, DeletesContacts $deletesContacts)
    {
        $contact = Ally::newContactModel()->findOrFail($contact);

        $deletesContacts(
            request()->user(),
            $contact
        );

        return request()->wantsJson() ? response()->json([]) : redirect()->to(
            request()->get('redirect', Ally::redirects('destroy', '/'))
        );
    }
}
