<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\ConferencePolicy;
use App\Policies\ThesisPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Thesis;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Conference::class => ConferencePolicy::class,
        Thesis::class => ThesisPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
