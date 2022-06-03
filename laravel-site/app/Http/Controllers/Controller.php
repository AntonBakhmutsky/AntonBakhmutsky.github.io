<?php

namespace App\Http\Controllers;

use App\Interfaces\Models\HasMetaData;
use App\MetaTags\HighlightTag;
use App\MetaTags\HtmlTag;
use App\Models\MetaTag;
use App\Models\Page;
use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
  protected string $sectionName = 'Главная';

  public function __construct(protected MetaInterface $meta)
  {
    $this->meta->setTitle($this->sectionName);
    $this->meta->addTag('h1', new HighlightTag($this->sectionName));
    $this->meta->setFavicon(asset('favicon.ico'));
  }

  protected function setDefaultItemMeta(HasMetaData $item): void
  {
    $this->meta->setTitle($item->name ?? $this->sectionName);
    $this->meta->setDescription(strip_tags($item->html ?? $this->meta->getDescription() ?? ''));
    $this->meta->addTag('h1', new HighlightTag($item->name ?? $this->sectionName));
  }

  protected function setItemMeta(HasMetaData $item): void
  {
    $this->setDefaultItemMeta($item);
    $this->setMeta($item->meta);
  }

  protected function setPageMeta(Page $page): void
  {
    $this->setMeta($page->meta);
    if ($page->hasTopHtml()) {
      $this->meta->addTag('top_content', new HtmlTag($page->html));
    }
    if ($page->hasBottomHtml()) {
      $this->meta->addTag('bottom_content', new HtmlTag($page->html));
    }
  }

  protected function setMeta(?MetaTag $meta): void
  {
    if ($meta) {
      if ($meta->title) {
        $this->meta->setTitle($meta->title);
      }
      if ($meta->description) {
        $this->meta->setDescription($meta->description);
      }
      if ($meta->keywords) {
        $this->meta->setKeywords($meta->keywords);
      }
      if ($meta->h1) {
        $this->meta->addTag('h1', new HighlightTag($meta->h1));
      }
    }
  }

  protected function view(string $view, array $data = []): View
  {
    if ($page = Page::getByUrl(request()->getPathInfo())) {
      $this->setPageMeta($page);
    }
    return view($view, $data);
  }


}
