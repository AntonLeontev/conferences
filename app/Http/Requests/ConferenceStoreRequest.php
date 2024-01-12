<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class ConferenceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->organization()->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title_ru' => ['required', 'string', 'max:250'],
            'title_en' => ['required', 'string', 'max:250'],
            'conference_type_id' => ['required', 'in:'.conference_types()->pluck('id')->join(',')],
            'format' => ['required', 'string', 'max:255'],
            'with_foreign_participation' => ['required', 'boolean'],
            'subjects' => ['required', 'array'],
            'subjects.*' => ['required', 'int', 'in:'.subjects()->pluck('id')->join(',')],
            'sections' => ['nullable', 'array', 'max:8'],
            'sections.*.title_ru' => ['required', 'string', 'max:255'],
            'sections.*.short_title_ru' => ['required', 'string', 'max:255'],
            'sections.*.title_en' => ['required', 'string', 'max:255'],
            'sections.*.short_title_en' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image'],
            'website' => ['nullable', 'url', 'max:255'],
            'co-organizers' => ['nullable', 'array'],
            'co-organizers.*' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', new Phone()],
            'email' => ['required', 'email'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'description_ru' => ['required', 'string', 'max:1000'],
            'description_en' => ['required', 'string', 'max:1000'],
            'lang' => ['required', 'string', 'max:255'],
            'participants_number' => ['required', 'string', 'max:255'],
            'report_form' => ['required', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'url', 'max:255'],
            'telegram' => ['nullable', 'url', 'max:255'],
            'price_participants' => ['nullable', 'integer', 'min:0', 'max:999999999'],
            'price_visitors' => ['nullable', 'integer', 'min:0', 'max:999999999'],
            'discount_students' => ['sometimes'],
            'discount_participants' => ['sometimes'],
            'discount_special_guest' => ['sometimes'],
            'discount_young_scientist' => ['sometimes'],
            'abstracts_price' => ['nullable', 'integer', 'min:0', 'max:999999999'],
            'abstracts_format' => ['required', 'string', 'max:255'],
            'abstracts_lang' => ['required', 'string', 'max:255'],
        ];
    }
}
