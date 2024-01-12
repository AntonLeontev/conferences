<?php

namespace Src\Domains\Conferences\Actions;

use Illuminate\Http\Request;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Section;

class CreateConferenceSections
{
    public function handle(Request $request, Conference $conference): void
    {
        foreach ($request->get('sections') as $section) {
            $this->createSection($section, $conference);
        }
    }

    public function createSection(array $section, Conference $conference): Section
    {
        return Section::create([
            'conference_id' => $conference->id,
            'title_ru' => $section['title_ru'],
            'short_title_ru' => $section['short_title_ru'],
            'title_en' => $section['title_en'],
            'short_title_en' => $section['short_title_en'],
        ]);
    }
}
