<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipationStoreRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Src\Domains\Conferences\Actions\CreateParticipation;
use Src\Domains\Conferences\Models\Conference;

class ParticipationController extends Controller
{
    public function create(Conference $conference): View|Factory
    {
        return view('my.events.participate', compact('conference'));
    }

    public function store(
        Conference $conference,
        ParticipationStoreRequest $request,
        CreateParticipation $createParticipation
    ): JsonResponse {
        $participation = $createParticipation->handle($request);

        return response()->json(['redirect' => route('conference.show', $conference->slug)]);
    }
}
