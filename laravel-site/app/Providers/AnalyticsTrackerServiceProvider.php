<?php

namespace App\Providers;

use App\AnalyticsTracker\AnalyticsBag;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\ServiceProvider;

class AnalyticsTrackerServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/analytics-tracker.php', 'analytics-tracker');

        $this->app->singleton(AnalyticsBag::class, function ($app) {
            return new AnalyticsBag(
                $app->make(Session::class),
                config('analytics-tracker.tracked_parameters'),
                config('analytics-tracker.session_key'),
            );
        });
    }
}
