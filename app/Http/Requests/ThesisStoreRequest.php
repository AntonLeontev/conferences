<?php

namespace App\Http\Requests;

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
            'section_id' => ['nullable', 'int'],
            'report_form' => ['required', Rule::enum(ReportForm::class)],
            'title' => ['required', 'string', 'max:255'],
            'authors' => ['required', 'array', 'min:1'],
            'authors.*.name_ru' => ['required', 'string', 'max:255', 'regex:/^[а-яА-Я \-_]+$/u'],
            'authors.*.surname_ru' => ['required', 'string', 'max:255', 'regex:/^[а-яА-Я \-_]+$/u'],
            'authors.*.middle_name_ru' => ['nullable', 'string', 'max:255', 'regex:/^[а-яА-Я \-_]+$/u'],
            'authors.*.name_en' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z \-_]+$/u'],
            'authors.*.surname_en' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z \-_]+$/u'],
            'authors.*.middle_name_en' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z \-_]+$/u'],
            'authors.*.affiliations' => ['nullable', 'array'],
            'reporter' => ['required', 'array'],
            'reporter.id' => ['required', 'int'],
            'reporter.is_young' => ['required', 'boolean'],
            'contact' => ['required', 'array'],
            'contact.id' => ['required', 'int'],
            'contact.email' => ['required', 'email'],
            'text' => ['required', 'string', 'max:2500'],
        ];
    }

    protected function passedValidation()
    {
        if ($this->route('conference')->end_date < now()) {
            abort(Response::HTTP_BAD_REQUEST, 'Попытка отправить тезисы на завершившееся событие');
        }
    }
}
