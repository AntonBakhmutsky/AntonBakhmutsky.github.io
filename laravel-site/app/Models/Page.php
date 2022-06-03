<?php

namespace App\Models;

use App\Interfaces\Models\Activatable;
use App\Interfaces\Models\HasMetaData;
use App\Interfaces\Models\HasPublicPage;
use App\Interfaces\Models\Loggable;
use App\Traits\Models\SoftDeletes;
use App\Traits\Models\WithActiveAttribute;
use App\Traits\Models\WithHtmlAttribute;
use App\Traits\Models\WithMeta;
use App\Traits\Models\WithUserAttributes;
use Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements Activatable, Loggable, HasPublicPage, HasMetaData
{
  use HasFactory;
  use WithUserAttributes;
  use SoftDeletes;
  use WithActiveAttribute;
  use WithHtmlAttribute;
  use WithMeta;

  public const CACHE_TTL = 86400;
  public const CACHE_KEY = 'pages';

  protected $keyType = 'string';

  protected $guarded = ['id'];

  public const TEXT_TOP_POSITION = 'top';
  public const TEXT_BOTTOM_POSITION = 'bottom';

  public static function getByUrl(string $url): ?static
  {
    $page = Cache::tags(static::CACHE_KEY)->remember(
      'url:' . $url,
      Page::CACHE_TTL,
      fn() => static::whereUrl($url)->active()->first(['id', 'html', 'name', 'text_position']) ?? false
    );

    return $page === false ? null : $page;
  }

  public function getLinkAttribute(): ?string
  {
    return $this->code ? route('page', [$this->code]) : null;
  }
}
