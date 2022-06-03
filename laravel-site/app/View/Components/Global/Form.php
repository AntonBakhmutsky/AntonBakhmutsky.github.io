<?php

namespace App\View\Components\Global;

use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
use Illuminate\View\View;

class Form extends Component
{
  public function __construct(
    public string $title,
    private ?string $productId = null,
    private ?string $image = null
  ) {
  }

  public function render(): View|string
  {
    return view('components.global.form');
  }

  public function showImage(): HtmlString
  {
    return new HtmlString(
      ! is_null($this->image)
        ? '<div class="form__image"><img class="lazyload" data-src="' . asset($this->image) . '" alt="angel"></div>'
        : ''
    );
  }

  public function showProductInput(): HtmlString
  {
    return \Form::hidden('product_id', $this->productId);
  }
}
