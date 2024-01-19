<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class ParticipantUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name_ru' => ['nullable', 'max:255', 'string', 'regex:~[а-яА-Я0-9\-_ ]+~u'],
            'surname_ru' => ['nullable', 'max:255', 'string', 'regex:~[а-яА-Я0-9\-_ ]+~u'],
            'middle_name_ru' => ['nullable', 'max:255', 'string', 'regex:~[а-яА-Я0-9\-_ ]+~u'],
            'name_en' => ['nullable', 'max:255', 'string', 'regex:~[a-zA-Z0-9\-_ ]+~u'],
            'surname_en' => ['nullable', 'max:255', 'string', 'regex:~[a-zA-Z0-9\-_ ]+~u'],
            'middle_name_en' => ['nullable', 'max:255', 'string', 'regex:~[a-zA-Z0-9\-_ ]+~u'],
            'phone' => ['nullable', 'max:50', 'string', new Phone],
            'affiliations' => ['nullable', 'array'],
            'affiliations.*.id' => ['nullable'],
            'affiliations.*.title_ru' => ['required', 'string', 'max:255', 'regex:~[а-яА-Я0-9\-_ ]+~u'],
            'affiliations.*.title_en' => ['required', 'string', 'max:255', 'regex:~[a-zA-Z0-9\-_ ]+~u'],
            'orcid_id' => ['nullable', 'max:50', 'regex:~\d{4}-\d{4}-\d{4}-\d{4}~u'],
            'website' => ['nullable', 'url', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name_ru' => 'Имя (RU)',
            'surname_ru' => 'Фамилия (RU)',
            'middle_name_ru' => 'Отчество (RU)',
            'name_en' => 'First name (ENG)',
            'surname_en' => 'Surname (ENG)',
            'middle_name_en' => 'Middle name (ENG)',
            'phone' => 'Телефон',
            'orcid_id' => 'ORCID ID',
            'website' => 'Сайт',
        ];
    }

    public function messages(): array
    {
        return [
            'name_ru.regex' => 'Недопустимые символы в поле :attribute',
            'surname_ru.regex' => 'Недопустимые символы в поле :attribute',
            'middle_name_ru.regex' => 'Недопустимые символы в поле :attribute',
            'name_en.regex' => 'Недопустимые символы в поле :attribute',
            'surname_en.regex' => 'Недопустимые символы в поле :attribute',
            'middle_name_en.regex' => 'Недопустимые символы в поле :attribute',
        ];
    }
}
