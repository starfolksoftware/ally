<?php

use Illuminate\Support\Facades\Route;
use Ally\Http\Controllers\ContactController;

Route::group([
    'middleware' => config('ally.middleware', ['web']),
], function () {
    Route::resource('contacts', ContactController::class)->only(['store', 'update', 'destroy']);
});
