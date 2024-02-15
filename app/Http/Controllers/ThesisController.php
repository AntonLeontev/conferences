<?php

namespace App\Http\Controllers;

use App\Events\ThesisCreated;
use App\Http\Requests\ThesisStoreRequest;
use App\Http\Requests\ThesisUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Src\Domains\Conferences\Actions\CreateThesis;
use Src\Domains\Conferences\Actions\UpdateThesis;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Thesis;

class ThesisController extends Controller
{
    public function indexByConference(Conference $conference): View|Factory
    {
        $theses = $conference->theses;

        return view('my.events.theses.index-by-conference', compact('conference', 'theses'));
    }

    public function show(Conference $conference, Thesis $thesis): View|Factory
    {
        $thesis->load('participation');

        return view('my.events.theses.show', compact('conference', 'thesis'));
    }

    public function create(Conference $conference): View|Factory
    {
        $participation = $conference->participationByUser();

        return view('my.events.theses.create', compact('conference', 'participation'));
    }

    public function store(
        Conference $conference,
        ThesisStoreRequest $request,
        CreateThesis $createThesis,
    ): JsonResponse {
        $thesis = $createThesis->handle($request);

        event(new ThesisCreated($thesis));

        return response()->json(['redirect' => route('conference.show', $conference->slug)]);
    }

    public function edit(Conference $conference, Thesis $thesis): View|Factory
    {
        $participation = $conference->participationByUser();

        return view('my.events.theses.edit', compact('conference', 'participation', 'thesis'));
    }

    public function update(
        Conference $conference,
        Thesis $thesis,
        ThesisUpdateRequest $request,
        UpdateThesis $updateThesis,
    ): JsonResponse {
        $updateThesis->handle($thesis, $request);

        return response()->json(['redirect' => route('conference.show', $conference->slug)]);
    }

    public function destroy(Thesis $thesis): JsonResponse
    {
        $thesis->delete();

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
