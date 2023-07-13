<?php

use Ally\Contact;
use Ally\Contracts\DeletesContacts;
use Ally\Tests\Mocks\TestUser;

beforeAll(function () {
    \Ally\Ally::supportsTeams(false);
});

it('can delete a category', function () {
    $deletesContacts = app(DeletesContacts::class);

    $user = TestUser::first();

    $category = Contact::factory()->create();

    $deletesContacts($user, $category);

    expect(Contact::count())->toEqual(0);
});
