<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Src\Domains\Conferences\Models\Conference;

class CsvController extends Controller
{
    public function thesesById(Conference $conference)
    {
        $conference->load([
            'theses' => function (HasManyThrough $query) {
                $query
                    ->whereIn('theses.id', request('theses', []))
                    ->select(['theses.id', 'theses.title', 'thesis_id', 'theses.created_at', 'authors', 'section_id']);
            },
        ]);

        $lang = $conference->abstracts_lang->value;

        $writer = SimpleExcelWriter::streamDownload('abstracts.csv');
        $writer->addHeader(['ID', 'Заголовок', 'Авторы', 'Дата подачи']);

        foreach ($conference->theses as $thesis) {
            $authors = '';

            foreach ($thesis->authors as $author) {
                $authors .= "{$author['name_'.$lang]} {$author['surname_'.$lang]}, ";
            }

            $writer->addRow([
                $thesis->thesis_id,
                $thesis->title,
                trim($authors, ', '),
                $thesis->created_at,
            ]);
        }

        $writer->toBrowser();
    }
}
