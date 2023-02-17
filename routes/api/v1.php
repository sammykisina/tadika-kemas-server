<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Admin\EventController;
use App\Http\Controllers\Api\V1\Admin\PerformanceController;
use App\Http\Controllers\Api\V1\Admin\StudentRegistrationController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
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
