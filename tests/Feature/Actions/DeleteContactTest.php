<?php

use Ally\Contracts\DeletesContacts;
use Ally\Tests\Mocks\Contact as MocksContact;
use Ally\Tests\Mocks\TestUser;

beforeAll(function () {
    \Ally\Ally::supportsTeams(false);
    \Ally\Ally::useContactModel(MocksContact::class);
});

it('can delete a contact', function () {
    $deletesContacts = app(DeletesContacts::class);

    $user = TestUser::first();

    $contact = \Ally\Ally::newContactModel()->factory()->create();

    $deletesContacts($user, $contact);

    expect(\Ally\Ally::newContactModel()->count())->toEqual(0);
});
