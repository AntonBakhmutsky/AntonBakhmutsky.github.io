<?php


namespace App\Models\MenuItem;


use App\Models\MenuItem;

class MainMenuItem extends MenuItem
{
  public function getType(): ?string
  {
    return $this::TYPE_MAIN;
  }
}
