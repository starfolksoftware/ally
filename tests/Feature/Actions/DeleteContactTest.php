<?php

use StarfolkSoftware\Ally\Contact;
use StarfolkSoftware\Ally\Contracts\DeletesContacts;
use StarfolkSoftware\Ally\Tests\Mocks\TestUser;

beforeAll(function () {
    \StarfolkSoftware\Ally\Ally::supportsTeams(false);
});

it('can delete a category', function () {
    $deletesContacts = app(DeletesContacts::class);

    $user = TestUser::first();

    $category = Contact::factory()->create();

    $deletesContacts($user, $category);

    expect(Contact::count())->toEqual(0);
});