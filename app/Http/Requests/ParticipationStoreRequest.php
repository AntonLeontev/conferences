<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Src\Domains\Conferences\Enums\ParticipationType;

class ParticipationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return participant()->id == $this->get('participant_id');
    }

    public function rules(): array
    {
        return [
            'participant_id' => ['required', 'exists:participants,id'],
            'conference_id' => ['required', 'exists:conferences,id'],
            'name_ru' => ['required', 'string', 'max:255', 'regex:/^[а-яА-Я \-_]+$/u'],
            'surname_ru' => ['required', 'string', 'max:255', 'regex:/^[а-яА-Я \-_]+$/u'],
            'middle_name_ru' => ['nullable', 'string', 'max:255', 'regex:/^[а-яА-Я \-_]+$/u'],
            'name_en' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z \-_]+$/u'],
            'surname_en' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z \-_]+$/u'],
            'middle_name_en' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z \-_]+$/u'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', new Phone],
            'affiliations' => ['nullable', 'array'],
            'affiliations.*.id' => ['nullable'],
            'affiliations.*.title_ru' => ['required', 'string', 'max:255', 'regex:~[а-яА-Я0-9\-_ ]+~u'],
            'affiliations.*.title_en' => ['required', 'string', 'max:255', 'regex:~[a-zA-Z0-9\-_ ]+~u'],
            'affiliations.*.country' => ['array', 'nullable'],
            'affiliations.*.country.id' => ['sometimes', 'required', 'exists:countries,id'],
            'orcid_id' => ['nullable', 'string', 'regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/'],
            'website' => ['nullable', 'url', 'max:255'],
            'participation_type' => ['required', Rule::enum(ParticipationType::class)],
            'is_young' => ['required', 'boolean'],
        ];
    }

    protected function passedValidation()
    {
        if ($this->route('conference')->end_date < now()) {
            abort(Response::HTTP_BAD_REQUEST, 'Попытка зарегистрироваться на завершившееся событие');
        }
    }
}
