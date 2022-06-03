<?php

namespace App\AnalyticsTracker;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AnalyticsBag
{

  public function __construct(protected Session $session, protected array $trackedParameters, protected string $sessionKey)
  {
  }

  public function putFromRequest(Request $request): void
  {
    foreach ($this->determineFromRequest($request) as $key => $value) {
      $this->session->put("{$this->sessionKey}.$key", $value);
    }
  }

  public function get(): array
  {
    return $this->session->get($this->sessionKey, []);
  }

  protected function determineFromRequest(Request $request): array
  {
    return collect($this->trackedParameters)
      ->mapWithKeys(
        function ($trackedParameter) use ($request): array {
          /** @var \App\AnalyticsTracker\Sources\Source $source */
          $source = new $trackedParameter['source']($request);

          return [$trackedParameter['key'] => $source->get($trackedParameter['key'])];
        }
      )
      ->filter()
      ->toArray();
  }
}
