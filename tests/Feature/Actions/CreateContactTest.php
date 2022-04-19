<?php

use StarfolkSoftware\Ally\Contracts\CreatesContacts;
use StarfolkSoftware\Ally\Tests\Mocks\TestUser;

beforeAll(function () {
    \StarfolkSoftware\Ally\Ally::supportsTeams(false);
});

it('can create a tax', function () {
    $createsContacts = app(CreatesContacts::class);

    $user = TestUser::first();

    $tax = $createsContacts(
        $user,
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

    expect($tax->refresh())
        ->name->toBe('Contact');
});
