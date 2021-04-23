<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvitationsController;
use App\Http\Controllers\VerificationController;

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

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('register', [RegisterController::class, 'register'])->middleware('hasInvitation')->name('register');
Route::post('email/verify/{userId}', [VerificationController::class, 'verify'])->name('email.verify');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/invitations', [InvitationsController::class, 'index'])->middleware('can:isAdmin')->name('invitation.list');
    Route::post('/invitations', [InvitationsController::class, 'store'])->middleware('can:isAdmin')->name('invitation.create');
    Route::put('/profile', [UserController::class, 'update'])->middleware('verified')->name('update.profile');
});