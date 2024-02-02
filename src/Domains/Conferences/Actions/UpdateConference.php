<?php

namespace Src\Domains\Conferences\Actions;

use Illuminate\Http\Request;
use Src\Domains\Conferences\Models\Conference;

class UpdateConference
{
    public function handle(Conference $conference, Request $request): void
    {
        $conference->update([
            'title_ru' => $request->get('title_ru'),
            'title_en' => $request->get('title_en'),
            'conference_type_id' => $request->get('conference_type_id'),
            'format' => $request->get('format'),
            'with_foreign_participation' => $request->get('with_foreign_participation'),
            'website' => $request->get('website'),
            'need_site' => $request->get('need_site'),
            'co-organizers' => $request->get('co-organizers'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'description_ru' => $request->get('description_ru'),
            'description_en' => $request->get('description_en'),
            'lang' => $request->get('lang'),
            'participants_number' => $request->get('participants_number'),
            'report_form' => $request->get('report_form'),
            'whatsapp' => $request->get('whatsapp'),
            'telegram' => $request->get('telegram'),
            'price_participants' => $request->get('price_participants'),
            'price_visitors' => $request->get('price_visitors'),
            'discount_students' => $request->get('discount_students'),
            'discount_participants' => $request->get('discount_participants'),
            'discount_special_guest' => $request->get('discount_special_guest'),
            'discount_young_scientist' => $request->get('discount_young_scientist'),
            'abstracts_price' => $request->get('abstracts_price'),
            'abstracts_format' => $request->get('abstracts_format'),
            'abstracts_lang' => $request->get('abstracts_lang'),
            'max_thesis_characters' => $request->get('max_thesis_characters'),
            'thesis_accept_until' => $request->get('thesis_accept_until'),
            'thesis_edit_until' => $request->get('thesis_edit_until'),
            'thesis_instruction' => $request->get('thesis_instruction'),
        ]);

        $conference->subjects()->sync($request->get('subjects'));
    }
}
