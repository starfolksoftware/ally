<?php

use Illuminate\Contracts\Auth\Authenticatable;
use StarfolkSoftware\Ally\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

/**
 * Set the currently logged in user for the application.
 *
 * @return TestCase
 */
function actingAs(Authenticatable $user, string $driver = null)
{
    return test()->actingAs($user, $driver);
}
