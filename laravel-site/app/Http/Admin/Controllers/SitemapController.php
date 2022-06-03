<?php


namespace App\Http\Admin\Controllers;


use AdminSection;
use Artisan;
use Illuminate\View\View;
use SleepingOwl\Admin\Form\Buttons\FormButton;

class SitemapController extends Controller
{

  public function index(): View
  {
    $button = new FormButton();
    $button->setText('Сгенерировать новую карту')->setIconClass('fab fa-mendeley');
    $button->setHtmlAttributes(
      $button->getHtmlAttributes() + [
        'type' => 'submit',
        'name' => 'refresh',
        'class' => 'btn btn-primary',
      ]
    );

    return AdminSection::view(view('admin.sitemap', compact('button')), 'Карта сайта');
  }

  public function refresh(): View
  {
    Artisan::call('sitemap:generate');

    return $this->index();
  }
}
