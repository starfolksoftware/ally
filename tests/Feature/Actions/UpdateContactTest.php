<?php

use Ally\Contracts\UpdatesContacts;
use Ally\Tests\Mocks\Contact as MocksContact;
use Ally\Tests\Mocks\TestUser;

beforeAll(function () {
    \Ally\Ally::supportsTeams(false);
    \Ally\Ally::useContactModel(MocksContact::class);
});

it('can update a contact', function () {
    $updatesContacts = app(UpdatesContacts::class);

    $user = TestUser::first();

    $contact = \Ally\Ally::newContactModel()->factory()->create();

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
