<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class SitemapGenerateCommand extends Command
{
  protected $signature = 'sitemap:generate';

  protected $description = 'Generates sitemap.xml';


  public function handle(): int
  {
    $bar = $this->output->createProgressBar(2);

    $bar->start();

    $sitemap = SitemapGenerator::create(config('app.url'))
      ->hasCrawled(
        function (Url $url): ?Url {
          $uri = parse_url($url->url);
          if (($uri['path'] ?? '') === '/' || str_contains($uri['query'] ?? '', 'page=')) {
            return null;
          }
          return $url;
        }
      )
      ->getSitemap();

    $bar->advance();

    $sitemap->writeToFile(public_path('sitemap.xml'));

    $bar->advance();

    $bar->finish();

    return 0;
  }
}
