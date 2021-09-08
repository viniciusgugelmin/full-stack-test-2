<?php

use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Providers\{
    ProvidersController,
    ProvidersHoursController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* API */
Route::prefix('admin')->namespace('Admin')->group(function () {

    Route::prefix('user')->namespace('User')->group(function () {

        /* User */
        //
        // Register
        Route::post('/', [UserController::class, 'register']);
        // [AUTH]
        Route::middleware(['auth:api'])->group(function () {
            // Returns user
            Route::get('/', [UserController::class, 'getUser']);
            // Verify email
            Route::put('/verify-email', [UserController::class, 'verifyEmail']);
        });
        // Login
        Route::post('/login', [UserController::class, 'login']);
    });

    /* Providers */
    Route::prefix('providers')->namespace('Providers')->group(function () {

        /* Provider */
        //
        // Create a provider
        Route::post('/', [ProvidersController::class, 'create']);

        /* Hour */
        //
        // Create provider hours
        Route::post('/{id}/hours', [ProvidersHoursController::class, 'create']);

    });
});
