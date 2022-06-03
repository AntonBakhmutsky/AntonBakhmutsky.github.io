<?php

namespace App\View\Components\Global;

use Illuminate\View\Component;
use Illuminate\View\View;
use Lavary\Menu\Collection;
use Tags;

class Tabs extends Component
{
  public function __construct(public Collection $collection)
  {
  }

  public function render(): View|string
  {
    return $this->collection->count() > 0 ? view('components.global.tabs') : '';
  }
}
