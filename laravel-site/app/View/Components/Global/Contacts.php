<?php

namespace App\View\Components\Global;

use Illuminate\View\Component;
use Illuminate\View\View;

class Contacts extends Component
{
  public function __construct(public bool $lazy = false, public bool $removeTitle = false)
  {
  }

  public function render(): View|string
    {
        return view('components.global.contacts');
    }
}
