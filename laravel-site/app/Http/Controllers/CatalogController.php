<?php

namespace App\Http\Controllers;

use App\Models\CatalogCategory;
use App\Models\CatalogProduct;
use Catalog;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;

class CatalogController extends Controller
{
  protected string $sectionName = 'Каталог';

  public function index(): RedirectResponse
  {
    return redirect()->to(Catalog::homepage());
  }

  public function category(string $categoryCode): View
  {
    $category = CatalogCategory::active()
      ->with(
        [
          'children' => fn(HasMany $builder) => $builder->active()->sorted(),
          'children.children' => fn(HasMany $builder) => $builder->active()->sorted()
        ]
      )
      ->whereCode($categoryCode)->firstOrFail();

    $showFullPage = Paginator::resolveCurrentPage() === 1 || ! request()->ajax();

    if ($category->isTabbed() || $category->isHorizontal()) {
      $category->loadProductsByPage();
      $view = $showFullPage ? 'pages.catalog.horizontal_category' : 'pages.catalog.products_page';
    } else {
      $view = 'pages.catalog.vertical_category';
    }

    if ($showFullPage) {
      $this->setItemMeta($category);
    }
    return $this->view($view, compact('category'));
  }

  public function product(string $categoryCode, string $productCode): View
  {
    $category = CatalogCategory::active()->whereCode($categoryCode)->firstOrFail();
    $product = CatalogProduct::active()->whereCategoryId($category->getKey())->whereCode($productCode)->firstOrFail();
    $this->setItemMeta($product);

    return $this->view('pages.catalog.product', compact('product', 'category'));
  }
}
