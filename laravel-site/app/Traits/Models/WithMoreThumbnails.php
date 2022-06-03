<?php


namespace App\Traits\Models;


use App\Helpers\Thumbnail;
use Arr;

trait WithMoreThumbnails
{
  use WithThumbnail;

  public static function bootWithMoreThumbnails(): void
  {
    static::deleted(
      function (self $model) {
        foreach ((array)$model->more_images as $image) {
          (new Thumbnail($image))->clear();
        }
      }
    );
    static::updated(
      function (self $model) {
        if ($model->wasChanged('more_images')) {
          foreach ((array)$model->getOriginal('more_images') as $image) {
            (new Thumbnail($image))->clear();
          }
        }
      }
    );
  }

  public function getMoreThumbnailsAttribute(): array
  {
    return $this->moreThumbnails(120);
  }

  public function moreThumbnails(?int $width = null, ?int $height = null, ?string $format = null): array
  {
    $thumbnails = [];

    foreach ($this->more_images as $image) {
      $thumbnail = new Thumbnail($image, $width, $height, $format);
      $thumbnails[] = $thumbnail->resize()->filepath();
    }

    return $thumbnails;
  }

  public function allThumbnails(?int $width = null, ?int $height = null, ?string $format = null): array
  {
    if ($this->image) {
      return Arr::prepend($this->moreThumbnails($width, $height, $format), $this->thumbnail($width, $height, $format));
    }

    return $this->moreThumbnails($width, $height);
  }


  public function getAllImagesAttribute(): array
  {
    if ($this->image) {
      return Arr::prepend($this->more_images, $this->image);
    }

    return $this->more_images;
  }
}
