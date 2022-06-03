<?php


namespace App\Traits\Models;


use Illuminate\Support\Str;

trait WithHtmlAttribute
{
  public function hasHtml(): bool
  {
    return Str::length(trim(strip_tags($this->html))) > 0;
  }

  public function hasTopHtml(): bool
  {
    return $this->text_position === $this::TEXT_TOP_POSITION && $this->hasHtml();
  }

  public function hasBottomHtml(): bool
  {
    return $this->text_position === $this::TEXT_BOTTOM_POSITION && $this->hasHtml();
  }
}
