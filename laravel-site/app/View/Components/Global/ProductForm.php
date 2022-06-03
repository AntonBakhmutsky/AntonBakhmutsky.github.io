<?php

namespace App\View\Components\Global;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductForm extends Component
{
    public function __construct(
        public string $title,
        public ?string $productId = null
    ) {
    }
    
    public function render(): View|Factory|Htmlable|Closure|string|Application
    {
        return view('components.global.product-form');
    }
}