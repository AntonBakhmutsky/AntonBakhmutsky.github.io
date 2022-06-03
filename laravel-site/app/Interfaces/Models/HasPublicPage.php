<?php


namespace App\Interfaces\Models;


interface HasPublicPage
{
  public function getLinkAttribute(): ?string;
}
