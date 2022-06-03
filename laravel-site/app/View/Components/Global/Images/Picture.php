<?php

namespace App\View\Components\Global\Images;

use Illuminate\View\Component;
use Illuminate\View\View;

class Picture extends Component
{
  public function __construct(
    public ?string $webp = null,
    public ?string $png = null,
    public ?string $jpeg = null,
    public bool $lazy = false,
    public string $alt = 'image'
  ) {
  }

  public function render(): string|View
  {
    return view('components.global.images.picture');
  }
}
