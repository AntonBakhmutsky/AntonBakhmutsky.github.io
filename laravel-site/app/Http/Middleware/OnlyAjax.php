<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OnlyAjax
{
  public function handle(Request $request, Closure $next): mixed
  {
    if (! $request->ajax()) {
      throw new NotFoundHttpException();
    }
    return $next($request);
  }
}
