<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\RegistrationController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_organization_can_register(): void
    {
        $response = $this->post(action([RegistrationController::class, 'registerOrganization']), [
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'full_name_ru' => 'Организация',
            'short_name_ru' => 'Организация',
            'full_name_en' => 'Organization',
            'short_name_en' => 'Organization',
            'inn' => '12345678910',
            'address' => 'Москва',
            'phone' => '8-912-000-00-00',
            'type' => 'Университет',
            'actions' => ['Наука'],
        ]);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);

        $this->assertDatabaseHas('organizations', [
            'full_name_ru' => 'Организация',
            'short_name_ru' => 'Организация',
            'full_name_en' => 'Organization',
            'short_name_en' => 'Organization',
            'inn' => '12345678910',
            'address' => 'Москва',
            'phone' => '8-912-000-00-00',
            'type' => 'Университет',
        ]);

        $this->assertAuthenticated();
        $response->assertOk();
    }

    public function test_participant_can_register(): void
    {
        $response = $this->post(action([RegistrationController::class, 'registerParticipant']), [
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'name_ru' => 'name_ru',
            'surname_ru' => 'surname_ru',
            'middle_name_ru' => 'middle_name_ru',
            'name_en' => 'name_en',
            'surname_en' => 'surname_en',
            'middle_name_en' => 'middle_name_en',
            'phone' => '8-912-000-00-00',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);

        $this->assertDatabaseHas('participants', [
            'name_ru' => 'name_ru',
            'surname_ru' => 'surname_ru',
            'middle_name_ru' => 'middle_name_ru',
            'name_en' => 'name_en',
            'surname_en' => 'surname_en',
            'middle_name_en' => 'middle_name_en',
            'phone' => '8-912-000-00-00',
        ]);

        $this->assertAuthenticated();
        $response->assertOk();
    }
}
