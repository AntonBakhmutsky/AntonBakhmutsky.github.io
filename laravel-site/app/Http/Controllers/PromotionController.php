<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Contracts\View\View;

class PromotionController extends Controller
{
  protected string $sectionName = 'Акции';

  public function index(): View
  {
    $promotions = Promotion::active()->sorted()->get();
    return $this->view('pages.promotions.index', compact('promotions'));
  }

  public function promotion(string $promotionCode): View
  {
    $promotion = Promotion::active()->whereCode($promotionCode)->firstOrFail();
    $this->setItemMeta($promotion);
    return $this->view('pages.promotions.promotion', compact('promotion'));
  }
}
