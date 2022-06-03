<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;


/**
 * @method static string|bool get(string $code)
 */
class Settings extends Facade
{
  protected static function getFacadeAccessor(): string
  {
    return 'settings';
  }
}
