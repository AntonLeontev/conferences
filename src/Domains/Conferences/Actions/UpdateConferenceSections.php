<?php

namespace Src\Domains\Conferences\Actions;

use Illuminate\Http\Request;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Section;

class UpdateConferenceSections
{
    public function handle(Conference $conference, Request $request)
    {
        $oldSections = $conference->sections;

        $newSections = collect($request->get('sections'));

        $existingSections = $newSections->whereNotNull('id');
        $creatingSections = $newSections->whereNull('id');

        if ($oldSections->count() > $existingSections->count()) {
            $deletingSectionsIds = $oldSections->pluck('id')->diff($existingSections->pluck('id'));

            Section::whereIn('id', $deletingSectionsIds)->delete();
        }

        foreach ($creatingSections as $section) {
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
