<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['menu', 'analytics'])->group(
  function () {
    $alphaDash = '[a-zA-Z0-9_-]+';

    Route::get('', IndexController::class)->name('index');

    Route::get('/page/{pageCode}', PageController::class)
      ->name('page')
      ->where('pageCode', $alphaDash);

    Route::get('/contacts', [ContactsController::class, 'index'])
      ->name('contacts');
    Route::get('/contacts/{cemeteryCode}', [ContactsController::class, 'cemetery'])
      ->name('contacts.cemetery')
      ->where('cemeteryCode', $alphaDash);

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
    Route::get('/articles/{articleCode}', [ArticleController::class, 'article'])
      ->name('articles.article')
      ->where('articleCode', $alphaDash);

    Route::get('/promotions', [PromotionController::class, 'index'])
      ->name('promotions');
    Route::get('/promotions/{promotionCode}', [PromotionController::class, 'promotion'])
      ->name('promotions.promotion')
      ->where('promotionCode', $alphaDash);

    Route::get('/catalog', [CatalogController::class, 'index'])
      ->name('catalog');
    Route::get('/catalog/{categoryCode}', [CatalogController::class, 'category'])
      ->name('catalog.category')->where('categoryCode', $alphaDash);
    Route::get('/catalog/{categoryCode}/{productCode}', [CatalogController::class, 'product'])
      ->name('catalog.product')
      ->where(['categoryCode' => $alphaDash, 'productCode' => $alphaDash]);
  }
);

Route::post('/request', RequestController::class)
  ->name('request')
  ->middleware(['only_ajax', 'analytics']);

require __DIR__ . '/auth.php';
