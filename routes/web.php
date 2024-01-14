<?php

use App\Http\Controllers\ConferenceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Src\Domains\Conferences\Enums\AbstractsFormat;
use Src\Domains\Conferences\Enums\AbstractsLanguage;
use Src\Domains\Conferences\Enums\ConferenceFormat;
use Src\Domains\Conferences\Enums\ParticipantsNumber;
use Src\Domains\Conferences\Enums\ReportForm;
use Src\Domains\Conferences\Models\Conference;

Route::any('test', function () {

    dd(Conference::where('slug', 'like', 'event%')->get());

    $conf = Conference::create([
        'organization_id' => 1,
        'title_ru' => 'title',
        'title_en' => 'event',
        'conference_type_id' => 1,
        'format' => ConferenceFormat::international,
        'with_foreign_participation' => true,
        'address' => 'Moscow',
        'phone' => '+7-912-651-0464',
        'need_site' => false,
        'email' => 'aner-ant@ya.ru',
        'start_date' => '2024-01-31',
        'end_date' => '2024-01-31',
        'description_ru' => 'test',
        'description_en' => 'test',
        'lang' => 'ru',
        'participants_number' => ParticipantsNumber::from100to200,
        'report_form' => ReportForm::oral,
        'price_participants' => 200,
        'price_visitors' => null,
        'abstracts_price' => null,
        'abstracts_format' => AbstractsFormat::a4,
        'abstracts_lang' => AbstractsLanguage::en,
    ]);

    dd($conf);
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
