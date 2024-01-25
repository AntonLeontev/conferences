<?php

namespace Src\Domains\Conferences\Actions;

use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Section;

class CreateSection
{
    public function handle(array $sectionData, Conference $conference): Section
    {
        return Section::create([
            'conference_id' => $conference->id,
            'title_ru' => $sectionData['title_ru'],
            'short_title_ru' => $sectionData['short_title_ru'],
            'title_en' => $sectionData['title_en'],
            'short_title_en' => $sectionData['short_title_en'],
        ]);
    }
}
