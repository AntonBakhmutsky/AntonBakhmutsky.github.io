<?php

namespace App\AnalyticsTracker\Sources;

use App\AnalyticsTracker\Helpers\Request;

class CrossOriginRequestHeader extends RequestHeader implements Source
{
    public function get(string $key): ?string
    {
        if (! Request::isCrossOrigin($this->request)) {
            return null;
        }

        return parent::get($key);
    }
}
