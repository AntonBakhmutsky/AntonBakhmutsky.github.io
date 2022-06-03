<?php

namespace App\Http\Controllers;


use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;

class ArticleController extends Controller
{
  protected string $sectionName = 'Статьи';

  public function index(): View
  {
    $showFullPage = Paginator::resolveCurrentPage() === 1 || ! request()->ajax();

    $articles = Article::active()->orderBy('type')->orderBy('sort')->simplePaginate(10);
    $this->meta->setPaginationLinks($articles);
    return $this->view($showFullPage ? 'pages.articles.index' : 'pages.articles.articles_page', compact('articles'));
  }

  public function article(string $articleCode): View
  {
    $article = Article::active()->whereCode($articleCode)->firstOrFail();
    $sideArticles = Article::active()->inRandomOrder()->limit(3)->get();
    $this->setItemMeta($article);
    return $this->view('pages.articles.article', compact('article', 'sideArticles'));
  }
}
