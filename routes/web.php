<?php

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ThesisController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (app()->isLocal()) {
    Route::any('test', function () {
        $test = ['test' => 'foo'];

        dd(isset($test['foo']));
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
                ->post('password/edit', [PasswordChangeController::class, 'update'])
                ->name('my.password.update');

            // Participant
            Route::get('participant/create', [ParticipantController::class, 'create'])->name('participant.create');
            Route::middleware(['precognitive'])
                ->post('participant/store', [ParticipantController::class, 'store'])
                ->name('participant.store');
            Route::get('participant/edit', [ParticipantController::class, 'edit'])->name('participant.edit');
            Route::middleware(['precognitive'])
                ->post('participant/edit', [ParticipantController::class, 'update'])
                ->name('participant.update');
            Route::get('participant/events', [ConferenceController::class, 'participantIndex'])->name('events.participant-index');

            // Organizer
            Route::get('organization/create', [OrganizationController::class, 'create'])->name('organization.create');
            Route::middleware(['precognitive'])
                ->post('organization/store', [OrganizationController::class, 'store'])
                ->name('organization.store');
            Route::get('organization/events', [ConferenceController::class, 'organizationIndex'])->name('events.organization-index');

            Route::prefix('events')->group(function () {
                Route::get('create', [ConferenceController::class, 'create'])->name('conference.create');
                Route::middleware(['precognitive'])->post('create', [ConferenceController::class, 'store'])
                    ->name('conference.store');
                Route::get('{conference:slug}/edit', [ConferenceController::class, 'edit'])->name('conference.edit');
                Route::middleware(['precognitive'])->post('{conference:slug}/edit', [ConferenceController::class, 'update'])
                    ->name('conference.update');

                Route::get('{conference:slug}/participate', [ParticipationController::class, 'create'])->name('participation.create');
                Route::middleware(['precognitive'])
                    ->post('{conference:slug}/participate', [ParticipationController::class, 'store'])
                    ->name('participation.store');

                Route::get('{conference:slug}/abstracts/create', [ThesisController::class, 'create'])->name('theses.create');
                Route::middleware(['precognitive'])
                    ->post('{conference:slug}/abstracts/create', [ThesisController::class, 'store'])
                    ->name('theses.store');
                Route::get('{conference:slug}/abstracts/{thesis}/edit', [ThesisController::class, 'edit'])->name('theses.edit');
                Route::middleware(['precognitive'])
                    ->post('{conference:slug}/abstracts/{thesis}/edit', [ThesisController::class, 'update'])
                    ->name('theses.update');
            });
        });

    /**
     * Pages
     */
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/events/subject/{subject:slug}', [ConferenceController::class, 'subjectIndex'])->name('subject');
    Route::get('/events/{conference:slug}', [ConferenceController::class, 'show'])->name('conference.show');

    Route::view('/archive', 'archive')->name('archive');
    Route::view('/search', 'search')->name('search');
    Route::view('/announcement', 'announcement')->name('announcement');

    /**
     * PDF generation
     */
    Route::middleware(['auth'])
        ->post('pdf/events/{conference:slug}/thesis-preview', [PdfController::class, 'thesisPreview'])
        ->name('pdf.thesis.preview');
});

Route::middleware(['precognitive'])->post('feedback', FeedbackController::class)->name('feedback');
