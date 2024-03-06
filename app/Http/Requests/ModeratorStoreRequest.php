<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModeratorStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return organization()->id === $this->route('conference')->organization_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'moderable_type' => ['required', 'in:section,conference'],
            'moderable_id' => ['required', 'integer', 'min:1'],
            'email' => ['required', 'email', 'max:255'],
            'comment' => ['nullable', 'string', 'max:255'],
        ];
    }
}
