<?php

namespace App\Http\Middleware;

use App\MetaTags\CallTouch;
use App\MetaTags\GoogleTagManager;
use Butschster\Head\MetaTags\Entities\GoogleAnalytics;
use Butschster\Head\MetaTags\Entities\YandexMetrika;
use Closure;
use Illuminate\Http\Request;
use Settings;
use Tags;

class CreateAnalyticScripts
{
  public function handle(Request $request, Closure $next): mixed
  {
    $this->addAnalyticsTags();
    $this->addVerificationTags();

    return $next($request);
  }

  private function addAnalyticsTags(): void
  {
    // Google Analytics
    if ($ga = Settings::get('google_analytics')) {
      $script = new GoogleAnalytics($ga);
      Tags::addTag('google.analytics', $script);
    }

    // Google Tag Manager
    if ($gtm = Settings::get('google_tag_manager')) {
      $script = new GoogleTagManager($gtm);
      Tags::addTag('google.tagmanager', $script);
      $noscript = new GoogleTagManager($gtm, true);
      Tags::addTag('google.tagmanager.noscript', $noscript);
    }

    // Yandex Metrika
    if ($ym = Settings::get('yandex_metrika')) {
      $script = new YandexMetrika($ym);
      Tags::addTag('yandex.metrika', $script);
    }

    // Calltouch
    if ($ct = Settings::get('calltouch')) {
      $script = new CallTouch($ct);
      Tags::addTag('calltouch', $script);
    }
  }


  private function addVerificationTags(): void
  {
    if ($yv = Settings::get('yandex_verification')) {
      Tags::addMeta('yandex-verification', ['content' => $yv]);
    }
    if ($gv = Settings::get('google_verification')) {
      Tags::addMeta('google-site-verification', ['content' => $gv]);
    }
  }
}
