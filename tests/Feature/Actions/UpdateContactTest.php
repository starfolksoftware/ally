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
            'type' => 'customer',
            'meta' => [
                [
                    'label' => 'Email',
                    'value' => 'test@example.com',
                ],
                [
                    'label' => 'Phone',
                    'value' => '+1 (555) 555-5555',
                ],
            ],
        ]
    );

    expect($contact->refresh())
        ->name->toBe('Contact');
});