<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Domains\Conferences\Enums\ReportForm;
use Src\Domains\Conferences\Models\Participation;
use Src\Domains\Conferences\Models\Thesis;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ThesisFactory extends Factory
{
    protected $model = Thesis::class;

    public function definition(): array
    {
        $participation = Participation::inRandomOrder()->first();

        return [
            'thesis_id' => $this->faker->word(),
            'participation_id' => $participation->id,
            'report_form' => $this->faker->randomElement(ReportForm::cases()),
            'solicited_talk' => $this->faker->boolean(),
            'title' => $this->faker->title(),
            'authors' => [],
            'reporter' => [],
            'contact' => [],
            'text' => $this->faker->realText(400),
        ];
    }
}
