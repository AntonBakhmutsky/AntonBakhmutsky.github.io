<?php

namespace App\Models;

use App\Interfaces\Models\Activatable;
use App\Interfaces\Models\HasImageAttribute;
use App\Interfaces\Models\HasMetaData;
use App\Interfaces\Models\HasPublicPage;
use App\Interfaces\Models\Loggable;
use App\Interfaces\Models\Sortable;
use App\Traits\Models\CreateCodeFromName;
use App\Traits\Models\SoftDeletes;
use App\Traits\Models\WithActiveAttribute;
use App\Traits\Models\WithMeta;
use App\Traits\Models\WithSortAttribute;
use App\Traits\Models\WithThumbnail;
use App\Traits\Models\WithUserAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;

class Promotion extends Model implements Sortable, Activatable, Loggable, HasImageAttribute, HasPublicPage, HasMetaData
{
  use HasFactory;
  use WithThumbnail;
  use WithUserAttributes;
  use SoftDeletes;
  use WithMeta;
  use OrderableModel;
  use WithActiveAttribute;
  use WithSortAttribute;
  use CreateCodeFromName;

  protected $keyType = 'string';

  protected $guarded = ['id'];

  protected $dates = [
    'date_from',
    'date_to'
  ];

  protected $casts = [
    'show_on_home' => 'boolean'
  ];

  public function getLinkAttribute(): string
  {
    return route('promotions.promotion', $this->code);
  }
}
