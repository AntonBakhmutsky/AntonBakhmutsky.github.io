<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CatalogCategory;
use App\Models\CatalogProduct;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
  public function __invoke(): View
  {
    $catalog = CatalogCategory::active()->whereShowOnHome(true)->sorted()->limit(4)->get(['id', 'image', 'name', 'code']);
    $articles = Article::active()->whereShowOnHome(true)->sorted()->limit(15)->get(['id', 'image', 'preview', 'code', 'active_from']);
    $services = CatalogProduct::active()->whereShowOnHome(true)->sorted()->limit(8)->select(['id', 'name', 'image', 'code'])->get();

    return $this->view('pages.index', compact('catalog', 'articles', 'services'));
  }
}
