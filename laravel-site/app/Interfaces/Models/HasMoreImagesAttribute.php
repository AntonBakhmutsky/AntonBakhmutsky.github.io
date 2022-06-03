<?php


namespace App\Interfaces\Models;


interface HasMoreImagesAttribute extends HasImageAttribute
{
  public function getMoreThumbnailsAttribute(): array;

  public function moreThumbnails(?int $width = null, ?int $height = null, ?string $format = null): array;

  public function allThumbnails(?int $width = null, ?int $height = null, ?string $format = null): array;

  public function getAllImagesAttribute(): array;
}
