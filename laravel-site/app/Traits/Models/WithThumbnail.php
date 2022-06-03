<?php


namespace App\Traits\Models;


use App\Helpers\Thumbnail;

trait WithThumbnail
{
  public static function bootWithThumbnail(): void
  {
    static::deleted(
      function (self $model) {
        if ($model->image) {
          (new Thumbnail($model->image))->clear();
        }
      }
    );
    static::updated(
      function (self $model) {
        if ($model->wasChanged('image') && $model->getOriginal('image')) {
          (new Thumbnail($model->getOriginal('image')))->clear();
        }
      }
    );
  }

  public function getThumbnailAttribute(): ?string
  {
    return $this->thumbnail(120);
  }

  public function thumbnail(?int $width = null, ?int $height = null, ?string $format = null): ?string
  {
    if ($this->image) {
      $thumb = new Thumbnail($this->image, $width, $height, $format);
      return $thumb->resize()->filepath();
    }

    return null;
  }
}
