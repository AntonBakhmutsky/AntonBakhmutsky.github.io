<?php

namespace App\AnalyticsTracker;

use App\AnalyticsTracker\Helpers\Url;

class AnalyticsTracker
{
    public function __construct(protected AnalyticsBag $analyticsBag)
    {
    }

    public function get(): array
    {
        return $this->analyticsBag->get();
    }

    public function decorateUrl(string $url): string
    {
        $analyticsParameters = $this->analyticsBag->get();
        $analyticsParameters = $this->mapParametersToUrlParameters($analyticsParameters);

        return Url::addParameters($url, $analyticsParameters);
    }

    protected function mapParametersToUrlParameters(array $parameters): array
    {
        $mapping = config('analytics-tracker.parameter_url_mapping');

        return collect($parameters)
            ->mapWithKeys(fn (string $value, string $parameter) => [$mapping[$parameter] ?? $parameter => $value])
            ->toArray();
    }
}
