<?php

namespace App\AnalyticsTracker\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\AnalyticsTracker\AnalyticsBag;

class TrackAnalyticsParametersMiddleware
{

    public function __construct(protected AnalyticsBag $analyticsBag)
    {
    }

    public function handle(Request $request, Closure $next): mixed
    {
        $this->analyticsBag->putFromRequest($request);

        return $next($request);
    }
}
