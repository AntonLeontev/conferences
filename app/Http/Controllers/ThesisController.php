<?php

namespace App\Http\Controllers;

use App\Events\ThesisCreated;
use App\Http\Requests\ThesisStoreRequest;
use App\Http\Requests\ThesisUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Src\Domains\Conferences\Actions\CreateThesis;
use Src\Domains\Conferences\Actions\UpdateThesis;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Thesis;

class ThesisController extends Controller
{
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
}
