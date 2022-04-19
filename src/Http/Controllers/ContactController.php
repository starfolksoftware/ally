<?php

namespace StarfolkSoftware\Ally\Http\Controllers;

use StarfolkSoftware\Ally\Ally;
use StarfolkSoftware\Ally\Contact;
use StarfolkSoftware\Ally\Contracts\CreatesContacts;
use StarfolkSoftware\Ally\Contracts\DeletesContacts;
use StarfolkSoftware\Ally\Contracts\UpdatesContacts;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \StarfolkSoftware\Ally\Contracts\CreatesContacts  $createsContacts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatesContacts $createsContacts)
    {
        $contact = $createsContacts(
            request()->user(),
            request()->all()
        );

        return request()->wantsJson() ? response()->json(['contact' => $contact]) : redirect()->to(
            request()->get('redirect', Ally::redirects('store', '/'))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \StarfolkSoftware\Ally\Contact  $contact
     * @param  \StarfolkSoftware\Ally\Contracts\UpdatesContacts  $updatesContacts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Contact $contact, UpdatesContacts $updatesContacts)
    {
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
     * @param  \StarfolkSoftware\Ally\Contact  $contact
     * @param  \StarfolkSoftware\Ally\Contracts\DeletesContacts  $deletesContacts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact, DeletesContacts $deletesContacts)
    {
        $deletesContacts(
            request()->user(),
            $contact
        );

        return request()->wantsJson() ? response()->json([]) : redirect()->to(
            request()->get('redirect', Ally::redirects('destroy', '/'))
        );
    }
}
