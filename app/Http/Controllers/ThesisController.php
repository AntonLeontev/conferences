<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThesisStoreRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Src\Domains\Conferences\Actions\CreateThesis;
use Src\Domains\Conferences\Models\Conference;

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

        return response()->json(['redirect' => route('conference.show', $conference->slug)]);
    }
}
