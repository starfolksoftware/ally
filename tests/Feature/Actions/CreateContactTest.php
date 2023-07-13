<?php

use Ally\Contracts\CreatesContacts;
use Ally\Tests\Mocks\TestUser;

beforeAll(function () {
    \Ally\Ally::supportsTeams(false);
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
