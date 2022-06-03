<?php

namespace App\Http;

use App\AnalyticsTracker\Middleware\TrackAnalyticsParametersMiddleware;
use App\Http\Middleware\CreateAnalyticScripts;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\GenerateMenu;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Http\Middleware\RecaptchaMiddleware;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\VerifyCsrfToken;
use Fruitcake\Cors\HandleCors;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
  /**
   * The application's global HTTP middleware stack.
   *
   * These middlewares are run during every request to your application.
   *
   * @var array
   */
  protected $middleware = [
    // \App\Http\Middleware\TrustHosts::class,
    TrustProxies::class,
    HandleCors::class,
    PreventRequestsDuringMaintenance::class,
    ValidatePostSize::class,
    TrimStrings::class,
    ConvertEmptyStringsToNull::class,
  ];

  /**
   * The application's route middleware groups.
   *
   * @var array
   */
  protected $middlewareGroups = [
    'web' => [
      EncryptCookies::class,
      AddQueuedCookiesToResponse::class,
      StartSession::class,
      // \Illuminate\Session\Middleware\AuthenticateSession::class,
      ShareErrorsFromSession::class,
      VerifyCsrfToken::class,
      SubstituteBindings::class
    ],

    'analytics' => [
      TrackAnalyticsParametersMiddleware::class,
      CreateAnalyticScripts::class
    ]
  ];

  /**
   * The application's route middleware.
   *
   * These middleware may be assigned to groups or used individually.
   *
   * @var array
   */
  protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'only_ajax' => \App\Http\Middleware\OnlyAjax::class,
    'menu' => GenerateMenu::class,
    'recaptcha' => RecaptchaMiddleware::class
  ];
}
