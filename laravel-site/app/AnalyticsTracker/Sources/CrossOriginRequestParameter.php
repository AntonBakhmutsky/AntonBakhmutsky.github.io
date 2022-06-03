<?php

namespace App\AnalyticsTracker\Sources;

use App\AnalyticsTracker\Helpers\Request;

class CrossOriginRequestParameter extends RequestParameter implements Source
{
    public function get(string $key): ?string
    {
        if (! Request::isCrossOrigin($this->request)) {
            return null;
        }

        return parent::get($key);
    }
}
