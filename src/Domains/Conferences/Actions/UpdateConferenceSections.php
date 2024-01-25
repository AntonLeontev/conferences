<?php

namespace Src\Domains\Conferences\Actions;

use Illuminate\Http\Request;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Section;

class UpdateConferenceSections
{
    public function __construct(private CreateSection $createSection)
    {
    }

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
            $this->createSection->handle($section, $conference);
        }
    }
}
