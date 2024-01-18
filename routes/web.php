<?php

use App\Http\Controllers\ConferenceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::any('test', function () {

    echo preg_match('~^[\x{0430}-\x{044F}\x{0410}-\x{042F}0-9\-_]+$~u', 'фыва');
    echo preg_match('~^[а-яА-Я0-9\-_]+$~m', '123');
    echo preg_match('~^[а-яА-Я0-9\-_]+$~u', 'фыва');
});

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
        ->middleware(['auth', 'verified'])
        ->group(function () {
            // Participant

            // Organizer
            Route::prefix('events')->group(function () {
                Route::get('create', [ConferenceController::class, 'create'])->name('conference.create');
                Route::middleware(['precognitive'])->post('create', [ConferenceController::class, 'store'])
                    ->name('conference.store');
            });
        });

    /**
     * Pages
     */
    Route::view('/', 'home')->name('home');
    Route::get('/events/subject/{subject:slug}', [ConferenceController::class, 'subjectIndex'])->name('subject');
    Route::get('/events/{conference:slug}', [ConferenceController::class, 'show'])->name('conference.show');

    Route::view('/archive', 'archive')->name('archive');
    Route::view('/search', 'search')->name('search');
    Route::view('/announcement', 'announcement')->name('announcement');
});
