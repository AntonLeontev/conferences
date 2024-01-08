<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Src\Domains\Auth\Models\User;

class ParticipantRegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['confirmed', Password::default()],

            'name_ru' => ['nullable', 'max:255', 'string'],
            'surname_ru' => ['nullable', 'max:255', 'string'],
            'middle_name_ru' => ['nullable', 'max:255', 'string'],
            'name_en' => ['nullable', 'max:255', 'string'],
            'surname_en' => ['nullable', 'max:255', 'string'],
            'middle_name_en' => ['nullable', 'max:255', 'string'],
            'phone' => ['nullable', 'max:50', 'string', new Phone],
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
        ];
    }
}
