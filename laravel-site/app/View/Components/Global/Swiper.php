<?php

namespace App\View\Components\Global;

use Illuminate\View\Component;
use Illuminate\View\View;

class Swiper extends Component
{
  public function __construct(public array $items = [], public string $alt = 'image')
  {
    $this->items = array_map('asset', $this->items);
  }

  public function render(): View|string
  {
    return view('components.global.swiper');
  }
}
