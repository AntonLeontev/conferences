<?php

namespace Tests\Feature;

use App\Http\Controllers\ConferenceController;
use Database\Factories\OrganizationFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Domains\Conferences\Enums\AbstractsFormat;
use Src\Domains\Conferences\Enums\AbstractsLanguage;
use Src\Domains\Conferences\Enums\ConferenceFormat;
use Src\Domains\Conferences\Enums\ConferenceLanguage;
use Src\Domains\Conferences\Enums\ParticipantsNumber;
use Src\Domains\Conferences\Enums\ReportForm;
use Src\Domains\Conferences\Models\ConferenceType;
use Src\Domains\Conferences\Models\Subject;
use Tests\TestCase;

class ConferenceCreateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_creating_conference(): void
    {
        $this->seed();

        $user = UserFactory::new()->create();
        $organization = OrganizationFactory::new()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->post(action([ConferenceController::class, 'store']), [
            'title_ru' => 'Компания',
            'title_en' => 'Company',
            'conference_type_id' => ConferenceType::inRandomOrder()->first()->id,
            'format' => fake()->randomElement(ConferenceFormat::values()),
            'with_foreign_participation' => true,
            'need_site' => true,
            'co-organizers' => ['test1'],
            'address' => 'Москва',
            'phone' => '+7-912-000-56-23',
            'email' => 'aner-ant@ya.ru',
            'start_date' => '2024-01-03',
            'end_date' => '2024-01-06',
            'description_ru' => 'Описание',
            'description_en' => 'Description',
            'lang' => fake()->randomElement(ConferenceLanguage::values()),
            'participants_number' => fake()->randomElement(ParticipantsNumber::values()),
            'report_form' => fake()->randomElement(ReportForm::values()),
            'price_participants' => 250,
            'price_visitors' => '',
            'discount_students' => '',
            'discount_participants' => '',
            'discount_special_guest' => '',
            'discount_young_scientist' => '',
            'abstracts_price' => 500,
            'abstracts_format' => fake()->randomElement(AbstractsFormat::values()),
            'abstracts_lang' => fake()->randomElement(AbstractsLanguage::values()),
            'subjects' => [Subject::inRandomOrder()->first()->id],
            'sections' => [
                [
                    'short_title_ru' => 'Секция 1',
                    'title_ru' => 'Секция 1',
                    'short_title_en' => 'Секция 1',
                    'title_en' => 'Секция 1',
                ],
                [
                    'short_title_ru' => 'Секция 2',
                    'title_ru' => 'Секция 2',
                    'short_title_en' => 'Секция 2',
                    'title_en' => 'Секция 2',
                ],
            ],
        ]);

        $this->assertDatabaseCount('conferences', 1);
        $this->assertDatabaseHas('conferences', [
            'organization_id' => $organization->id,
            'title_ru' => 'Компания',
            'title_en' => 'Company',
            'with_foreign_participation' => true,
            'need_site' => true,
            // 'co-organizers' => json_encode(['test1'], JSON_UNESCAPED_UNICODE),
            'address' => 'Москва',
            'phone' => '+7-912-000-56-23',
            'email' => 'aner-ant@ya.ru',
            'start_date' => '2024-01-03',
            'end_date' => '2024-01-06',
            'description_ru' => 'Описание',
            'description_en' => 'Description',
            'price_participants' => 250,
            'price_visitors' => null,
            'discount_students' => null,
            'discount_participants' => null,
            'discount_special_guest' => null,
            'discount_young_scientist' => null,
            'abstracts_price' => 500,
        ]);

        $this->assertDatabaseCount('sections', 2);
        $this->assertDatabaseHas('sections', [
            'short_title_ru' => 'Секция 1',
            'title_ru' => 'Секция 1',
            'short_title_en' => 'Секция 1',
            'title_en' => 'Секция 1',
        ]);
        $this->assertDatabaseHas('sections', [
            'short_title_ru' => 'Секция 2',
            'title_ru' => 'Секция 2',
            'short_title_en' => 'Секция 2',
            'title_en' => 'Секция 2',
        ]);

        $this->assertDatabaseCount('conference_subject', 1);

        $response->assertCreated();
    }
}
