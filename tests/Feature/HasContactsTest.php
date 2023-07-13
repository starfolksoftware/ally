<?php

use Ally\Tests\Mocks\Contact as MocksContact;
use Ally\Tests\Mocks\TestProduct;

beforeAll(function () {
    \Ally\Ally::supportsTeams(false);
    \Ally\Ally::useContactModel(MocksContact::class);
});

it('can sync contact to a model', function () {
    $contact = \Ally\Ally::newContactModel()->factory()->create();

    list($product) = TestProduct::factory()->count(5)->create();

    $product->syncContacts($contact);

    expect($product->contacts()->count())->toBe(1);

    expect($product->contacts()->first())
        ->id->toBe($contact->id)
        ->team_id->toBeNull()
        ->type->toBe($contact->type)
        ->name->toBe($contact->name)
        ->meta->toBe($contact->meta);

    // test that only one product has contact
    expect($product->hasContacts($contact))->toBeTrue();
    expect($product->hasAllContacts($contact))->toBeTrue();
    expect(TestProduct::withAllContacts($contact)->count())->toBe(1);
    expect(TestProduct::withAnyContacts($contact)->count())->toBe(1);
    expect(TestProduct::withoutContacts($contact)->count())->toBe(4);
    expect(TestProduct::withoutAnyContacts()->count())->toBe(4);
});

it('can attach and detach contact to a model', function () {
    list($contact1, $contact2, $contact3) = \Ally\Ally::newContactModel()->factory()->count(3)->create();

    list($product) = TestProduct::factory()->count(5)->create();

    $product->attachContacts([$contact1->id, $contact2->id]);

    expect($product->contacts()->count())->toBe(2);

    expect(TestProduct::withoutContacts($contact3)->count())->toBe(5);

    expect($product->contacts()->first())
        ->id->toBe($contact1->id)
        ->team_id->toBeNull()
        ->type->toBe($contact1->type)
        ->name->toBe($contact1->name)
        ->meta->toBe($contact1->meta);

    $product->detachContacts($contact1);

    expect($product->contacts()->count())->toBe(1);

    expect(TestProduct::withAnyContacts($contact2)->count())->toBe(1);

    $product->detachContacts();

    expect($product->contacts()->count())->toBe(0);

    expect(TestProduct::withoutAnyContacts()->count())->toBe(5);
});
