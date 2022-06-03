<?php


namespace App\Interfaces\Models;


interface HasImageAttribute
{
  public function getThumbnailAttribute(): ?string;

  public function thumbnail(?int $width = null, ?int $height = null, ?string $format = null): ?string;
}
