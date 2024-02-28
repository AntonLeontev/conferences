<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Thesis;

class PdfController extends Controller
{
    public function thesisPreview(Request $request, Conference $conference)
    {
        $authors = $request->json('authors');

        $sectionSlug = $conference->sections->isNotEmpty()
            ? '-'.$conference->sections->where('id', $request->json('section_id'))->first()?->slug
            : '';
        $thesisId = $conference->slug.$sectionSlug;

        $title = $request->get('title');
        $reporter = $request->json('reporter');
        $contact = $request->json('contact');
        $text = str($request->json('text'))->replace('<br>', ' ');

        return PDF::loadView('pdf.thesis', compact('conference', 'authors', 'thesisId', 'title', 'reporter', 'contact', 'text'))
            ->download('abstracts.pdf');
    }

    public function thesisDownload(Conference $conference, Thesis $thesis)
    {
        $authors = $thesis->authors;
        $thesisId = $thesis->thesis_id;
        $title = $thesis->title;
        $reporter = $thesis->reporter;
        $contact = $thesis->contact;
        $text = $thesis->text;

        return PDF::loadView('pdf.thesis', compact('conference', 'authors', 'thesisId', 'title', 'reporter', 'contact', 'text'))
            ->download($thesisId.'.pdf');
    }
}
