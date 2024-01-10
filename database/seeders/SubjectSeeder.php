<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Src\Domains\Conferences\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->list() as $titles) {
            Subject::create([
                'title_ru' => $titles['ru'],
                'title_en' => $titles['en'],
            ]);
        }
    }

    private function list(): array
    {
        return [
            [
                'ru' => 'Математика',
                'en' => 'Mathematics',
            ],
            [
                'ru' => 'Физика',
                'en' => 'Physics',
            ],
            [
                'ru' => 'Химия',
                'en' => 'Chemistry',
            ],
            [
                'ru' => 'Науки о Земле',
                'en' => 'Geosciences',
            ],
            [
                'ru' => 'Информатика',
                'en' => 'Computer science',
            ],
            [
                'ru' => 'Инженерия',
                'en' => 'Engineering',
            ],
            [
                'ru' => 'Медицина',
                'en' => 'Medicine',
            ],
            [
                'ru' => 'Науки о жизни',
                'en' => 'Life Sciences',
            ],
            [
                'ru' => 'Социальные науки',
                'en' => 'Social sciencies',
            ],
            [
                'ru' => 'Тренинги',
                'en' => 'Trainings',
            ],
        ];
    }
}
