<?php

use Ally\Ally;
use Ally\Contracts\CreatesContacts;
use Ally\Tests\Mocks\Contact;
use Ally\Tests\Mocks\TeamModel;
use Ally\Tests\Mocks\TestUser;

beforeAll(function () {
    Ally::supportsTeams(false);
    \Ally\Ally::useContactModel(Contact::class);
});

it('can create a contact with team support', function () {
    $team = TeamModel::forceCreate(['name' => 'Test Team']);

    Ally::supportsTeams();

    Ally::useTeamModel(TeamModel::class);

    $createsContacts = app(CreatesContacts::class);

    $user = TestUser::first();

    $contact = $createsContacts(
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
        ],
        $team->id,
    );

    expect($contact->refresh())
        ->name->toBe('Contact');

    expect($contact->refresh()->team)
        ->id->toBe($team->id)
        ->name->toBe('Test Team');

    expect($team->refresh()->contacts()->count())
        ->toBe(1);
});
