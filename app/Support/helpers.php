<?php

use Illuminate\Database\Eloquent\Collection;
use Src\Domains\Conferences\Models\Subject;

if (! function_exists('subjects')) {
    function subjects(): Collection
    {
        return Subject::all();
    }
}
