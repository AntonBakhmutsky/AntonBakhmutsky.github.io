<?php


namespace App\Http\Admin\Controllers;


use AdminSection;
use Artisan;
use Cache;
use File;
use Illuminate\Http\Request;
use Illuminate\View\View;
use SleepingOwl\Admin\Form\Buttons\FormButton;

class CacheController extends Controller
{
  public function index(): View
  {
    $totalImageSize = 0;
    foreach (File::allFiles(public_path(config('image.cache.directory'))) as $file) {
      $totalImageSize += $file->getSize();
    }
    $totalImageSize = round($totalImageSize / 1024 / 1024, 2);

    $clearAllButton = new FormButton();
    $clearAllButton->setText("Очистить кэш сайта");
    $clearAllButton->setHtmlAttributes(
      $clearAllButton->getHtmlAttributes() + [
        'type' => 'submit',
        'name' => 'clear',
        'class' => 'btn btn-primary',
      ]
    );

    $clearImagesButton = clone $clearAllButton;
    $clearImagesButton->setText("Очистить кэш картинок");

    return AdminSection::view(view('admin.cache', compact('totalImageSize', 'clearAllButton', 'clearImagesButton')), 'Кэширование');
  }

  public function clear(Request $request): View
  {
    (bool)$request->post('all') === true
      ? Artisan::call('cache:clear')
      : Cache::tags(config('image.cache.key'))->flush();

    File::cleanDirectory(public_path(config('image.cache.directory')));
    return $this->index();
  }
}
