<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Claim;
use App\Observers\ClaimObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Claim::observe(ClaimObserver::class);
    }
}
