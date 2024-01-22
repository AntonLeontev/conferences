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
                $query->where(function ($builder) use ($request) {
                    $builder->where('title_ru', 'like', '%'.$request->get('search').'%')
                        ->orWhere('title_en', 'like', '%'.$request->get('search').'%');
                });
            })
            ->when($request->has('except'), function (Builder $query) use ($request) {
                $query->whereNotIn('id', $request->get('except'));
            })
            ->take($request->get('limit') ?? 50)
            ->get(['id', 'title_ru', 'title_en']);

        return response()->json($affiliations);
    }
}
