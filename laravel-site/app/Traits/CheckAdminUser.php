<?php


namespace App\Traits;


use App\Models\User;
use Auth;
use Exception;

trait CheckAdminUser
{
  /**
   * @throws \Exception
   */
  public function checkAdminUser(): void
  {
    if (! ($user = User::orderBy('id')->first())) {
      throw new Exception('Please, create admin user by command "php artisan user:admin admin@admin.com"');
    }
    Auth::setUser($user);
  }
}
