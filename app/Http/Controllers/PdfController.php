<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Src\Domains\Conferences\Models\Conference;

class PdfController extends Controller
{
    public function thesisPreview(Request $request, Conference $conference)
    {
        // $sect = $conference->sections->where('id', $request->json('section_id'));

        // return response()->json($sect);

        return PDF::loadView('pdf.thesis-preview', compact('request', 'conference'))
            ->download('abstracts.pdf');
    }
}
