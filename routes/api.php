<?php

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

Route::middleware('auth:sanctum')->get(
    '/user', function (Request $request) {
        return $request->user();
    }
);

Route::post('/login', 'Api\AuthController@login')->name('login');
Route::post('/block-user', 'Api\AuthController@blockUser')->name('login.block');
Route::get('/is-blocked-ip/{ip}', 'Api\AuthController@isBlocked')->name('login.is.block');
Route::get('email/verify/{id}', 'Api\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Api\VerificationController@resend')->name('verification.resend');
Route::post('/reset-password', 'Api\ResetPasswordController')->name('reset.password');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', 'Api\AuthController@me')->name('users.me');
    Route::resources(
        [
            'user-permissions' => 'Api\UserPermissionController',
            'user-roles' => 'Api\UserRoleController',
            'users' => 'Api\UserController',
        ]
    );
});
