<?php

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PasswordChangeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (app()->isLocal()) {
    Route::any('test', function () {

        echo preg_match('~^[\x{0430}-\x{044F}\x{0410}-\x{042F}0-9\-_]+$~u', 'фыва');
        echo preg_match('~^[а-яА-Я0-9\-_]+$~m', '123');
        echo preg_match('~^[а-яА-Я0-9\-_]+$~u', 'фыва');
    });
}

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
            Route::get('password/edit', [PasswordChangeController::class, 'edit'])->name('my.password.edit');
            Route::middleware(['precognitive'])
                ->post('password/update', [PasswordChangeController::class, 'update'])
                ->name('my.password.update');

            // Participant
            Route::get('participant/create', [ParticipantController::class, 'create'])->name('participant.create');
            Route::middleware(['precognitive'])
                ->post('participant/store', [ParticipantController::class, 'store'])
                ->name('participant.store');
            Route::get('participant/edit', [ParticipantController::class, 'edit'])->name('participant.edit');
            Route::middleware(['precognitive'])
                ->post('participant/update', [ParticipantController::class, 'update'])
                ->name('participant.update');

            // Organizer
            Route::get('organization/create', [OrganizationController::class, 'create'])->name('organization.create');
            Route::middleware(['precognitive'])
                ->post('organization/store', [OrganizationController::class, 'store'])
                ->name('organization.store');

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
