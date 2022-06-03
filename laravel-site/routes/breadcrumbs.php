<?php

use App\Models\Article;
use App\Models\CatalogCategory;
use App\Models\CatalogProduct;
use App\Models\Cemetery;
use App\Models\Page;
use App\Models\Promotion;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Index
Breadcrumbs::for(
  'index',
  function (Generator $trail) {
    $trail->push('Главная', route('index'));
  }
);

// Index > [Page]
Breadcrumbs::for(
  'page',
  function (Generator $trail, Page $page) {
    $trail->parent('index');
    $trail->push($page->name, route('page', $page->code));
  }
);

// Index > Articles
Breadcrumbs::for(
  'articles',
  function (Generator $trail) {
    $trail->parent('index');
    $trail->push('Статьи', route('articles'));
  }
);

// Index > Articles > [Article]
Breadcrumbs::for(
  'articles.article',
  function (Generator $trail, Article $article) {
    $trail->parent('articles');
    $trail->push($article->name, route('articles.article', $article->code));
  }
);

// Index > Contacts
Breadcrumbs::for(
  'contacts',
  function (Generator $trail) {
    $trail->parent('index');
    $trail->push('Контакты', route('contacts'));
  }
);

// Index > Contacts > [Cemetery]
Breadcrumbs::for(
  'contacts.cemetery',
  function (Generator $trail, Cemetery $cemetery) {
    $trail->parent('contacts');
    $trail->push($cemetery->name, route('contacts.cemetery', $cemetery->code));
  }
);

// Index > Promotions
Breadcrumbs::for(
  'promotions',
  function (Generator $trail) {
    $trail->parent('index');
    $trail->push('Акции', route('promotions'));
  }
);

// Index > Promotions > [Promotion]
Breadcrumbs::for(
  'promotions.promotion',
  function (Generator $trail, Promotion $promotion) {
    $trail->parent('promotions');
    $trail->push($promotion->name, route('promotions.promotion', $promotion->code));
  }
);

// Index > Catalog > [Category]
Breadcrumbs::for(
  'catalog.category',
  function (Generator $trail, ?CatalogCategory $category) {
    if ($category?->parent_id) {
      $category->loadParentRelation();
      $trail->parent('catalog.category', $category->parent);
    } else {
      $trail->parent('index');
    }

    if ($category) {
      $trail->push($category->name, route('catalog.category', $category->code));
    }
  }
);

// Index > Catalog > [Category] > [Product]
Breadcrumbs::for(
  'catalog.product',
  function (Generator $trail, CatalogCategory $category, CatalogProduct $product) {
    $trail->parent('catalog.category', $category);
    $trail->push($product->name, route('catalog.product', [$category->code, $product->code]));
  }
);
