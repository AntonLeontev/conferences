<?php

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ThesisController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Src\Domains\Auth\Models\User;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Thesis;

if (app()->isLocal()) {
    Route::any('test', function () {
        $m = User::find(6)->moderatedSections;
        dd($m);
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
                Route::middleware(['precognitive'])
                    ->post('create', [ConferenceController::class, 'store'])
                    ->name('conference.store')
                    ->can('create', Conference::class);
                Route::get('{conference:slug}/edit', [ConferenceController::class, 'edit'])
                    ->name('conference.edit')
                    ->can('update', 'conference');
                Route::middleware(['precognitive'])
                    ->post('{conference:slug}/edit', [ConferenceController::class, 'update'])
                    ->name('conference.update')
                    ->can('update', 'conference');

                Route::get('{conference:slug}/participations', [ParticipationController::class, 'indexByConference'])
                    ->name('conference.participations')
                    ->can('viewParticipations', 'conference');
                Route::get('{conference:slug}/participation', [ParticipationController::class, 'create'])
                    ->name('participation.create');
                Route::middleware(['precognitive'])
                    ->post('{conference:slug}/participation', [ParticipationController::class, 'store'])
                    ->name('participation.store');
                Route::get('{conference:slug}/participation/edit', [ParticipationController::class, 'edit'])->name('participation.edit');
                Route::middleware(['precognitive'])
                    ->post('{conference:slug}/participation/edit', [ParticipationController::class, 'update'])
                    ->name('participation.update');

                Route::controller(ThesisController::class)->group(function () {
                    Route::get('{conference:slug}/abstracts', 'indexByConference')
                        ->name('theses.index-by-conference')
                        ->can('viewAbstracts', 'conference');
                    Route::get('{conference:slug}/abstracts/create', 'create')
                        ->name('theses.create')
                        ->can('create', Thesis::class);
                    Route::middleware(['precognitive'])
                        ->post('{conference:slug}/abstracts/create', 'store')
                        ->name('theses.store');
                    Route::get('{conference:slug}/abstracts/{thesis}', [ThesisController::class, 'show'])
                        ->name('theses.show')
                        ->can('viewAbstracts', 'conference');
                    Route::get('{conference:slug}/abstracts/{thesis}/edit', [ThesisController::class, 'edit'])
                        ->name('theses.edit')
                        ->can('update', 'thesis');
                    Route::middleware(['precognitive'])
                        ->post('{conference:slug}/abstracts/{thesis}/edit', [ThesisController::class, 'update'])
                        ->name('theses.update');
                    Route::delete('abstracts/{thesis}/edit', [ThesisController::class, 'destroy'])
                        ->name('theses.destroy')
                        ->can('delete', 'thesis');
                });

                Route::controller(SectionController::class)->group(function () {
                    Route::get('{conference:slug}/sections', 'index')
                        ->name('sections.index')
                        ->can('massSectionUpdate', 'conference');
                    Route::middleware(['precognitive'])
                        ->post('{conference:slug}/sections/mass-update', 'massUpdate')
                        ->name('sections.mass-update');
                });

                Route::controller(ModeratorController::class)->group(function () {
                    Route::middleware(['precognitive'])
                        ->post('{conference:slug}/moderators', 'store')
                        ->name('moderators.store');
                    Route::middleware([])
                        ->delete('{conference:slug}/moderators', 'destroy')
                        ->name('moderators.destroy');
                });
            });

            Route::controller(CsvController::class)->group(function () {
                Route::get('csv/events/{conference:slug}/theses', 'thesesById')
                    ->name('csv.theses.download')
                    ->can('viewAbstracts', 'conference');
                Route::get('csv/events/{conference:slug}/participations', 'participationsById')
                    ->name('csv.participations.download')
                    ->can('viewParticipations', 'conference');
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
    Route::middleware(['auth'])
        ->get('pdf/events/{conference:slug}/theses/{thesis}', [PdfController::class, 'thesisDownload'])
        ->name('pdf.thesis.download')
        ->can('viewAbstracts', 'conference');
});

Route::middleware(['precognitive'])->post('feedback', FeedbackController::class)->name('feedback');
