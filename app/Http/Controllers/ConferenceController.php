<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConferenceStoreRequest;
use App\Http\Requests\ConferenceUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Src\Domains\Conferences\Actions\CreateConference;
use Src\Domains\Conferences\Actions\CreateConferenceSections;
use Src\Domains\Conferences\Actions\UpdateConference;
use Src\Domains\Conferences\Actions\UpdateConferenceSections;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Subject;

class ConferenceController extends Controller
{
    public function organizationIndex(): View|Factory
    {
        $conferences = Conference::where('organization_id', organization()->id)
            ->with(['organization', 'subjects'])
            ->orderByDesc('start_date')
            ->get();

        return view('conferences', [
            'title' => 'Мои мероприятия',
            'h1' => 'Организуемые мероприятия',
            'conferences' => $conferences,
        ]);
    }

    public function participantIndex(): View|Factory
    {
        $conferenceIds = participant()->participations->pluck('conference_id');

        $conferences = Conference::whereIn('id', $conferenceIds)
            ->with(['organization', 'subjects'])
            ->orderByDesc('start_date')
            ->get();

        return view('conferences', [
            'title' => 'Мои мероприятия',
            'h1' => 'Мероприятия в которых Вы участвуете',
            'conferences' => $conferences,
        ]);
    }

    public function subjectIndex(Subject $subject): View|Factory
    {
        //TODO pagination
        $conferences = Conference::query()
            ->whereHas('subjects', function ($query) use ($subject) {
                return $query->where('subjects.id', $subject->id);
            })
            ->with(['subjects', 'organization'])
            ->get();

        return view('conferences', [
            'title' => $subject->{'title_'.loc()},
            'h1' => $subject->{'title_'.loc()},
            'breadcrumbs' => $subject->{'title_'.loc()},
            'conferences' => $conferences,
        ]);
    }

    public function create(): View|Factory
    {
        return view('my.events.create');
    }

    public function store(
        ConferenceStoreRequest $request,
        CreateConference $createConference,
        CreateConferenceSections $createConferenceSections,
    ): JsonResponse {
        $conference = $createConference->handle($request);

        $createConferenceSections->handle($request, $conference);

        return response()->json($conference, Response::HTTP_CREATED);
    }

    public function show(Conference $conference): View|Factory
    {
        $participation = user_participation($conference)?->load([
            'theses' => function ($query) {
                $query->select(['theses.id', 'theses.title', 'thesis_id', 'theses.created_at', 'participation_id']);
            },
        ]);

        return view('conference', compact('conference', 'participation'));
    }

    public function edit(Conference $conference): View|Factory
    {
        return view('my.events.personal.edit', compact('conference'));
    }

    public function update(
        Conference $conference,
        ConferenceUpdateRequest $request,
        UpdateConference $updateConference,
        UpdateConferenceSections $updateConferenceSections,
    ): JsonResponse {
        $updateConference->handle($conference, $request);

        $updateConferenceSections->handle($conference, $request);

        return response()->json(['redirect' => route('conference.show', $conference->slug)], Response::HTTP_OK);
    }
}
