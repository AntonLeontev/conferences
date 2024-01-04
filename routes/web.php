<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

/**
 * Auth
 */
Route::get('register', [RegistrationController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('register/organization', [RegistrationController::class, 'registerOrganization'])
    ->middleware(['guest', 'precognitive'])
    ->name('register.organization');

Route::post('register/participant', [RegistrationController::class, 'registerParticipant'])
    ->middleware(['guest', 'precognitive'])
    ->name('register.participant');

/**
 * Pages
 */
Route::view('/archive', 'archive')->name('archive');
Route::view('/search', 'search')->name('search');
Route::view('/announcement', 'announcement')->name('announcement');
Route::view('/subject/{subject}', 'subject')->name('subject');
Route::view('/subject/{subject}/{single}', 'single')->name('single');
Route::view('/subject/{subject}/{single}/{country}', 'country')->name('country');
