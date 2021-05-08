<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatusUpdateController;
use App\Http\Controllers\UserController;
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

// TODO: resources (posts)


Route::group([
    'middleware' => 'api',
    'prefix' => 'users'
], function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('activate_email/{code}', [AuthController::class, 'activateEmail']);

    Route::post('forgot_password', [AuthController::class, 'forgotPassword']);

    Route::group([
        'middleware' => 'auth:api',
    ], function() {
        // TODO: password reset
    });
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'user'
], function() {
    Route::get('me', [UserController::class, 'me']);
    Route::post('status/new', [StatusUpdateController::class, 'store']);
    Route::get('status/new', [StatusUpdateController::class, 'index']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
