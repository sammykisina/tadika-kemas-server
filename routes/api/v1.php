<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Admin\EventController;
use App\Http\Controllers\Api\V1\Admin\PerformanceController;
use App\Http\Controllers\Api\V1\Admin\StudentRegistrationController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Shared\ProfileController;
use Illuminate\Support\Facades\Route;

/**
 * auth routes
 */
Route::prefix('auth')->as('auth:')->group(function () {
    Route::post('login', LoginController::class)->name('login');
});

/**
 * routes to be accessed by admin (teacher)
 */
Route::group([
    'prefix' => 'admin',
    'as' => 'admin:',
    'middleware' => ['auth:sanctum', 'abilities:admin']
], function () {
    /**
     * student registration routes
     */
    Route::apiResource('students', StudentRegistrationController::class)->except(['show']);

    /**
     * student performance routes
     */
    Route::controller(PerformanceController::class)->group(function () {
        Route::get('/students/performances', 'index');
        Route::post('/students/{student}/performances', 'createStudentPerformance');
        Route::patch('/students/{student}/performances/{performance}', 'updateStudentPerformance');
    });

    /**
     * event management routes
     */
    Route::apiResource('events', EventController::class)->except(['show']);
});

/**
 * routes to be accessed by all authenticated users
 */
Route::group([
    'prefix' => 'users',
    'as' => 'users:',
    'middleware' => ['auth:sanctum']
], function () {
    /**
     * profile routes
     */
    Route::controller(ProfileController::class)->group(function () {
        Route::post('/profile', 'getProfile');
        Route::post('/profile/password-reset', 'resetPassword');
    });
});
