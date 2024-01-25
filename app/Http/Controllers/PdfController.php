<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Src\Domains\Conferences\Models\Conference;

class PdfController extends Controller
{
    public function thesisPreview(Request $request, Conference $conference)
    {
        return PDF::loadView('pdf.thesis-preview', compact('request', 'conference'))
            ->download('abstracts.pdf');
    }
}
