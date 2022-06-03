<?php

namespace App\Models;

use App\Helpers\Thumbnail;
use App\Interfaces\Models\Activatable;
use App\Interfaces\Models\HasImageAttribute;
use App\Interfaces\Models\HasMetaData;
use App\Interfaces\Models\HasPublicPage;
use App\Interfaces\Models\Loggable;
use App\Interfaces\Models\Sortable;
use App\Traits\Models\CreateCodeFromName;
use App\Traits\Models\SoftDeletes;
use App\Traits\Models\WithMeta;
use App\Traits\Models\WithSortAttribute;
use App\Traits\Models\WithThumbnail;
use App\Traits\Models\WithUserAttributes;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;

class Article extends Model implements Sortable, Activatable, Loggable, HasImageAttribute, HasPublicPage, HasMetaData
{
  use HasFactory;
  use WithUserAttributes;
  use SoftDeletes;
  use WithMeta;
  use OrderableModel;
  use WithThumbnail;
  use CreateCodeFromName;
  use WithSortAttribute;

  public const PREVIEW_VERTICAL_TYPE = 'vertical';
  public const PREVIEW_HORIZONTAL_TYPE = 'horizontal';

  protected $keyType = 'string';

  protected $guarded = ['id'];

  protected $dates = [
    'active_from',
    'active_to'
  ];

  protected $casts = [
    'show_on_home' => 'boolean',
    'active' => 'boolean'
  ];

  public function scopeActive(Builder $builder, bool $value = true): Builder
  {
    $builder->whereActive($value);
    $now = DB::raw('localtimestamp');

    if ($value) {
      $builder->where(
        fn(Builder $b) => $b->whereNull('active_from')->orWhereDate('active_from', '<=', $now)
      )->where(
        fn(Builder $b) => $b->whereNull('active_to')->orWhereDate('active_to', '>=', $now)
      );
    } else {
      $builder->where(
        fn(Builder $b) => $b->whereNotNull('active_from')->whereDate('active_from', '>', $now)
      )->orWhere(
        fn(Builder $b) => $b->whereNotNull('active_to')->whereDate('active_to', '<', $now)
      );
    }

    return $builder;
  }

  public function getLinkAttribute(): string
  {
    return route('articles.article', $this->code);
  }

  public function getColorAttribute()
  {
    if ($this->image) {
      $img = new Thumbnail($this->image, 100, format: 'jpeg');
      return $img->image()->limitColors(1)->pickColor(0, 0, 'array');
    }
    return [0, 0, 0, 1];
  }
}
