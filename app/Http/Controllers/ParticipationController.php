<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipationStoreRequest;
use App\Http\Requests\ParticipationUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Src\Domains\Conferences\Actions\CreateParticipation;
use Src\Domains\Conferences\Actions\UpdateParticipation;
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

    public function edit(Conference $conference): View|Factory
    {
        $participation = user_participation($conference);

        abort_if(is_null($participation), Response::HTTP_NOT_FOUND, 'Вы не подавали заявку на мероприятие');

        return view('my.events.edit-participation', compact('conference', 'participation'));
    }

    public function update(
        Conference $conference,
        ParticipationUpdateRequest $request,
        UpdateParticipation $updateParticipation,
    ): JsonResponse {
        $participation = user_participation($conference);

        $participation = $updateParticipation->handle($participation, $request);

        return response()->json(['redirect' => route('conference.show', $conference->slug)]);
    }
}
