<?php

namespace App\Http\Requests;

use App\Rules\MaxStripTagsCharacters;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Src\Domains\Conferences\Enums\ReportForm;

class ThesisStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool) auth()->user()->participant;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'participation_id' => ['required', 'exists:participations,id'],
            'section_id' => ['sometimes', 'required', 'int'],
            'report_form' => ['required', Rule::enum(ReportForm::class)],
            'title' => ['required', 'string', new MaxStripTagsCharacters(230)],
            'authors' => ['required', 'array', 'min:1'],
            'authors.*.name_ru' => ['sometimes', 'required', 'string', 'max:255', 'regex:/^[а-яА-Я \-_]+$/u'],
            'authors.*.surname_ru' => ['sometimes', 'required', 'string', 'max:255', 'regex:/^[а-яА-Я \-_]+$/u'],
            'authors.*.middle_name_ru' => ['sometimes', 'nullable', 'string', 'max:255', 'regex:/^[а-яА-Я \-_]+$/u'],
            'authors.*.name_en' => ['sometimes', 'required', 'string', 'max:255', 'regex:/^[a-zA-Z \-_]+$/u'],
            'authors.*.surname_en' => ['sometimes', 'required', 'string', 'max:255', 'regex:/^[a-zA-Z \-_]+$/u'],
            'authors.*.middle_name_en' => ['sometimes', 'nullable', 'string', 'max:255', 'regex:/^[a-zA-Z \-_]+$/u'],
            'authors.*.affiliations' => ['nullable', 'array'],
            'reporter' => ['required', 'array'],
            'reporter.id' => ['required', 'int'],
            'reporter.is_young' => ['required', 'boolean'],
            'contact' => ['required', 'array'],
            'contact.id' => ['required', 'int'],
            'contact.email' => ['required', 'email'],
            'text' => ['required', 'string', new MaxStripTagsCharacters($this->route('conference')->max_thesis_characters)],
        ];
    }

    protected function passedValidation()
    {
        if ($this->route('conference')->thesis_accept_until->endOfDay()->isPast()) {
            abort(Response::HTTP_BAD_REQUEST, 'Прием тезисов на это мероприятие завершен');
        }
    }
}
