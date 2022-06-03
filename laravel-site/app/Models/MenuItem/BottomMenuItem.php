<?php


namespace App\Models\MenuItem;


use App\Models\MenuItem;

class BottomMenuItem extends MenuItem
{
  public function getType(): ?string
  {
    return $this::TYPE_BOTTOM;
  }
}
