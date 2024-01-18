<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipantStoreRequest;
use App\Http\Requests\ParticipantUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Src\Domains\Auth\Models\Participant;

class ParticipantController extends Controller
{
    public function create(): View|Factory
    {
        return view('my.participant.create');
    }

    public function store(ParticipantStoreRequest $request): JsonResponse
    {
        Participant::create([
            'user_id' => auth()->id(),
            'name_ru' => $request->get('name_ru'),
            'surname_ru' => $request->get('surname_ru'),
            'middle_name_ru' => $request->get('middle_name_ru'),
            'name_en' => $request->get('name_en'),
            'surname_en' => $request->get('surname_en'),
            'middle_name_en' => $request->get('middle_name_en'),
            'phone' => $request->get('phone'),
            'orcid_id' => $request->get('orcid_id'),
            'website' => $request->get('website'),
        ]);

        return response()->json(['redirect' => route('participant.edit')]);
    }

    public function edit(): View|Factory
    {
        return view('my.participant.edit');
    }

    public function update(ParticipantUpdateRequest $request): JsonResponse
    {
        Participant::where(['user_id' => auth()->id()])
            ->update([
                'name_ru' => $request->get('name_ru'),
                'surname_ru' => $request->get('surname_ru'),
                'middle_name_ru' => $request->get('middle_name_ru'),
                'name_en' => $request->get('name_en'),
                'surname_en' => $request->get('surname_en'),
                'middle_name_en' => $request->get('middle_name_en'),
                'phone' => $request->get('phone'),
                'orcid_id' => $request->get('orcid_id'),
                'website' => $request->get('website'),
            ]);

        return response()->json(['redirect' => route('participant.edit')]);
    }
}
