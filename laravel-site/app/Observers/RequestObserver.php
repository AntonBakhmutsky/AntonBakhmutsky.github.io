<?php

namespace App\Observers;

use App\AnalyticsTracker\AnalyticsBag;
use App\Models\Request;

class RequestObserver
{
  public function creating(Request $request)
  {
    $request->fill(app(AnalyticsBag::class)->get());
    $request->formatPhone();
  }

}
