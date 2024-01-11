<?php

use Illuminate\Database\Eloquent\Collection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Src\Domains\Conferences\Models\ConferenceType;
use Src\Domains\Conferences\Models\Subject;

if (! function_exists('subjects')) {
    function subjects(): Collection
    {
        return Subject::all();
    }
}

if (! function_exists('conference_types')) {
    function conference_types(): Collection
    {
        return ConferenceType::all();
    }
}

if (! function_exists('loc')) {
    function loc(): string
    {
        return app()->getLocale();
    }
}

if (! function_exists('localize_url')) {
    function localize_url(string $url): string
    {
        return LaravelLocalization::localizeURL($url);
    }
}

if (! function_exists('localize_route')) {
    function localize_route(string $name, mixed $parameters = []): string
    {
        return LaravelLocalization::localizeURL(route($name, $parameters));
    }
}
