<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Src\Domains\Conferences\Models\Affiliation;

class ApiController extends Controller
{
    public function affiliations(Request $request)
    {
        $affiliations = Affiliation::query()
            ->when($request->has('search'), function (Builder $query) use ($request) {
                $query->where('title', 'like', '%'.$request->get('search').'%');
            })
            ->take($request->get('limit') ?? 10)
            ->get(['id', 'title']);

        return response()->json($affiliations);
    }
}
