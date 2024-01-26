<?php

namespace Tests\Feature;

use App\Http\Controllers\ThesisController;
use Database\Factories\ConferenceFactory;
use Database\Factories\OrganizationFactory;
use Database\Factories\ParticipantFactory;
use Database\Factories\ParticipationFactory;
use Database\Factories\SectionFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Src\Domains\Auth\Models\Organization;
use Src\Domains\Auth\Models\User;
use Src\Domains\Conferences\Enums\ReportForm;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Participation;
use Src\Domains\Conferences\Models\Section;
use Tests\TestCase;

class ThesisCreateTest extends TestCase
{
    use RefreshDatabase;

    protected User $participantUser;

    protected Conference $conference;

    protected Section $section;

    protected Participation $participation;

    protected Organization $organization;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $organizationUser = UserFactory::new()->create();
        $this->participantUser = UserFactory::new()->create();
        $this->organization = OrganizationFactory::new()->create([
            'user_id' => $organizationUser->id,
        ]);
        $this->conference = ConferenceFactory::new()->create([
            'organization_id' => $this->organization->id,
            'start_date' => now()->addDay(),
            'end_date' => now()->addDay(),
        ]);
        $this->section = SectionFactory::new()->create(['conference_id' => $this->conference->id]);
        $participant = ParticipantFactory::new()->create([
            'user_id' => $this->participantUser->id,
        ]);
        $this->participation = ParticipationFactory::new()->create();
    }

    public function test_creating_thesis(): void
    {
        $response = $this->actingAs($this->participantUser)->post(action([ThesisController::class, 'store'], $this->conference->slug), [
            'participation_id' => $this->participation->id,
            'section_id' => $this->section->id,
            'report_form' => ReportForm::mixed->value,
            'title' => '<p>Some title <sub>123</sub></p>',
            'authors' => [
                1 => [
                    'name_ru' => 'Антон',
                    'surname_ru' => 'Леонтьев',
                    'middle_name_ru' => '',
                    'name_en' => 'Anton',
                    'surname_en' => 'Leontev',
                    'middle_name_en' => '',
                ],
            ],
            'reporter' => ['id' => 1, 'is_young' => true],
            'contact' => ['id' => 1, 'email' => 'test@ya.ru'],
            'text' => '<p>some text</p>',
        ]);

        $response->assertOk();
    }

    public function test_fail_by_confarence_date(): void
    {
        $conference = ConferenceFactory::new()->create([
            'organization_id' => $this->organization->id,
            'start_date' => now()->subDay(),
            'end_date' => now()->subDay(),
        ]);

        $participation = ParticipationFactory::new()->create([
            'conference_id' => $conference->id,
        ]);

        $response = $this->actingAs($this->participantUser)->post(action([ThesisController::class, 'store'], $conference->slug), [
            'participation_id' => $participation->id,
            'report_form' => ReportForm::mixed->value,
            'title' => '<p>Some title <sub>123</sub></p>',
            'authors' => [
                1 => [
                    'name_ru' => 'Антон',
                    'surname_ru' => 'Леонтьев',
                    'middle_name_ru' => '',
                    'name_en' => 'Anton',
                    'surname_en' => 'Leontev',
                    'middle_name_en' => '',
                ],
            ],
            'reporter' => ['id' => 1, 'is_young' => true],
            'contact' => ['id' => 1, 'email' => 'test@ya.ru'],
            'text' => '<p>some text</p>',
        ]);

        $response->assertBadRequest();
    }
}
