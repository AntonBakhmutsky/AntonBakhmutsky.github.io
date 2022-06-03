<?php

namespace App\Http\Middleware;

use App\MetaTags\ReCaptcha;
use Closure;
use Illuminate\Http\Request;
use Settings;
use Tags;

class RecaptchaMiddleware
{
  public function handle(Request $request, Closure $next): mixed
  {
    if ($key = Settings::get('google_recaptcha_key')) {
      $script = new ReCaptcha($key);
      Tags::addTag('recaptcha', $script);
      Tags::addMeta('g-recaptcha-key', ['content' => $key]);
    }
    return $next($request);
  }
}
