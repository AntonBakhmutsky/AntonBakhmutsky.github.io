<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CreateAdminUserCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'user:admin {email}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Creates admin user';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle(): int
  {
    $email = $this->argument('email');
    $validator = Validator::make(
      ['email' => $email],
      ['email' => 'required|email']
    );

    if ($validator->fails()) {
      $this->error("You must specify real email after command signature. For example - admin:create admin@admin.com");
      return 1;
    }

    $password = $this->generatePassword();

    $newUser = new User(
      [
        'name' => $email,
        'email' => $email,
        'password' => Hash::make($password),
        'email_verified_at' => now()
      ]
    );
    $newUser->save();

    $this->info("User was successfully created! User password: $password");

    return 0;
  }

  public function generatePassword(): string
  {
    return App::environment('local') ? 'password' : Str::random();
  }
}
