<?php

use App\Http\Controllers\ConferenceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect'],
], function () {
    /**
     * Auth
     */
    include 'auth.php';

    /**
     * Personal cabinet
     */
    Route::prefix('my')
        ->middleware('auth')
        ->group(function () {
            // Participant
            Route::prefix('events')->group(function () {
                Route::get('create', [ConferenceController::class, 'create'])->name('conference.create');
            });
            // Organizer
        });

    /**
     * Pages
     */
    Route::view('/', 'home')->name('home');
    Route::view('/archive', 'archive')->name('archive');
    Route::view('/search', 'search')->name('search');
    Route::view('/announcement', 'announcement')->name('announcement');
    Route::view('/subject/{subject}', 'subject')->name('subject');
    Route::view('/subject/{subject}/{single}', 'single')->name('single');
    Route::view('/subject/{subject}/{single}/{country}', 'country')->name('country');

});
