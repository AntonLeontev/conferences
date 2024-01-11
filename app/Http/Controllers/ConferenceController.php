<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConferenceStoreRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Subject;

class ConferenceController extends Controller
{
    public function organizerIndex(): View|Factory
    {
        return view('conferences');
    }

    public function participantIndex(): View|Factory
    {
        return view('conferences');
    }

    public function subjectIndex(Subject $subject): View|Factory
    {
        //TODO pagination
        $conferences = Conference::query()
            ->whereHas('subjects', function ($query) use ($subject) {
                return $query->where('subjects.id', $subject->id);
            })
            ->get();

        return view('conferences', [
            'title' => $subject->{'title_'.app()->getLocale()},
            'h1' => $subject->{'title_'.app()->getLocale()},
            'breadcrumbs' => $subject->{'title_'.app()->getLocale()},
            'conferences' => $conferences,
        ]);
    }

    public function create(): View|Factory
    {
        return view('my.events.create');
    }

    public function store(ConferenceStoreRequest $request)
    {

    }

    public function show(Request $request): View|Factory
    {
        return view('conference');
    }
}
