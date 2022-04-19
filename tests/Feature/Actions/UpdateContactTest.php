<?php

use StarfolkSoftware\Ally\Contact;
use StarfolkSoftware\Ally\Contracts\UpdatesContacts;
use StarfolkSoftware\Ally\Tests\Mocks\TestUser;

beforeAll(function () {
    \StarfolkSoftware\Ally\Ally::supportsTeams(false);
});

it('can update a contact', function () {
    $updatesContacts = app(UpdatesContacts::class);

    $user = TestUser::first();

    $contact = Contact::factory()->create();

    $contact = $updatesContacts(
        $user,
        $contact,
        [
            'name' => 'Contact',
        ]
    );

    expect($contact->refresh())
        ->name->toBe('Contact');
});