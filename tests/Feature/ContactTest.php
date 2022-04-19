<?php

use StarfolkSoftware\Ally\Contact;
use StarfolkSoftware\Ally\Tests\Mocks\TestUser;

beforeAll(function () {
    \StarfolkSoftware\Ally\Ally::supportsTeams(false);
});

test('contact can be created', function () {
    $user = TestUser::first();

    $response = actingAs($user)->post(route('contacts.store'), [
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
        'redirect' => '/redirect/path',
    ]);

    $response->assertRedirect('/redirect/path');

    $this->assertDatabaseHas('contacts', [
        'name' => 'Contact',
        'type' => 'customer',
    ]);
});

test('contact can be updated', function () {
    $user = TestUser::first();

    $contact = Contact::factory()->create();

    $response = actingAs($user)->put(route('contacts.update', $contact), [
        'name' => 'Contact',
        'type' => 'customer',
        'redirect' => '/redirect/path',
    ]);

    $response->assertRedirect('/redirect/path');

    $this->assertDatabaseHas('contacts', [
        'name' => 'Contact',
        'type' => 'customer',
    ]);
});

test('contact can be deleted', function () {
    $user = TestUser::first();

    $contact = Contact::factory()->create();

    $response = actingAs($user)->delete(route('contacts.destroy', $contact), [
        'redirect' => '/redirect/path',
    ]);

    $response->assertRedirect('/redirect/path');

    expect(Contact::count())->toEqual(0);
});