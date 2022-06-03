<?php

namespace App\Console\Commands;

use Artisan;
use File;
use Illuminate\Console\Command;

class DatabaseRefreshCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'db:refresh';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Refresh database with seeding';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle(): int
  {
    Artisan::call('migrate:fresh', [], $this->output);
    Artisan::call('user:admin', ['email' => 'admin@admin.com'], $this->output);
    Artisan::call('db:seed', [], $this->output);
    Artisan::call('cache:clear', [], $this->output);

    $imagePublicPath = public_path(config('sleeping_owl.imagesUploadDirectory'));
    if (File::exists($imagePublicPath)) {
      File::cleanDirectory($imagePublicPath);
    }

    $thumbnailPublicPath = public_path(config('image.cache.directory'));
    if (File::exists($thumbnailPublicPath)) {
      File::cleanDirectory($thumbnailPublicPath);
    }

    return 0;
  }
}
