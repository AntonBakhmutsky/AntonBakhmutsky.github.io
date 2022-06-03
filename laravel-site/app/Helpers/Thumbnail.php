<?php


namespace App\Helpers;


use File;
use Illuminate\Support\Str;
use Image;
use Throwable;

class Thumbnail
{
  private ?int $width;
  private ?int $height;
  private string $format;

  private string $cachedImagePath;
  private bool $isResized = false;
  private \Intervention\Image\Image $image;

  public function __construct(private string $imagePath, ?int $width = null, ?int $height = null, ?string $format = null)
  {
    $this->width = ! is_null($width) && $width > 0 ? $width : null;
    $this->height = ! is_null($height) && $height > 0 ? $height : null;
    $this->format = $format ?? File::extension($this->imagePath);
    $this->setCachedImagePath();
  }

  public function resize(): static
  {
    $publicPath = public_path($this->cachedImagePath);

    try {
      if (! File::exists($publicPath)) {
        $this->image = Image::make($this->imagePath)->fit(
          $this->width,
          $this->height,
          function ($constraint) {
            $constraint->upsize();
          }
        )->save($publicPath, 95, $this->format);
      }
      $this->isResized = true;
    } catch (Throwable) {
    }

    return $this;
  }

  private function setCachedImagePath(): void
  {
    $ext = ($this->format ? ".$this->format" : '');
    $filename = md5(File::name($this->imagePath) . $ext) . "-{$this->width}x{$this->height}";
    $directory = config('image.cache.directory') . '/' . Str::substr($filename, 0, 3);
    $publicDirectory = public_path($directory);
    if (! File::exists($publicDirectory)) {
      File::makeDirectory($publicDirectory);
    }
    $this->cachedImagePath = "$directory/$filename$ext";
  }

  public function filepath(): string
  {
    return url($this->isResized ? $this->cachedImagePath : $this->imagePath);
  }

  /**
   * Удаляет закешированные изображения всех размеров
   */
  public function clear(): void
  {
    $search = public_path(Str::before($this->cachedImagePath, '-x')) . '*';
    foreach (File::glob($search) as $file) {
      File::delete($file);
    }
  }

  public function image(): \Intervention\Image\Image
  {
    $this->resize();
    return $this->image ?? Image::make($this->isResized ? $this->cachedImagePath : $this->imagePath);
  }
}
