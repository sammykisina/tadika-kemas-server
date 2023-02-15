<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/**
 * auth routes
 */
Route::prefix('auth')->as('auth:')->group(function () {
    // Route::post('login', LoginController::class)->name('login');
});

/**
 * routes to be accessed by admin (teacher)
 */
Route::group([
    'prefix' => 'admin',
    'as' => 'admin:',
    'middleware' => ['auth:sanctum', 'abilities:admin']
], function () {
   
});

