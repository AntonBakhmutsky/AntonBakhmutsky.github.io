<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
  public function __invoke(string $code): View
  {
    $page = Page::whereCode($code)->active()->firstOrFail();
    $this->setDefaultItemMeta($page);
    $this->setPageMeta($page);
    return view('pages.page', compact('page'));
  }
}
