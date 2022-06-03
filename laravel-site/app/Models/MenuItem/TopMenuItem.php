<?php


namespace App\Models\MenuItem;


use App\Models\MenuItem;

class TopMenuItem extends MenuItem
{
  public function getType(): ?string
  {
    return $this::TYPE_TOP;
  }
}
