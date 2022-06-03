<?php

namespace App\Models;

use App\Casts\PhoneArrayCast;
use App\Helpers\Map;
use App\Interfaces\Models\Activatable;
use App\Interfaces\Models\HasMetaData;
use App\Interfaces\Models\HasPublicPage;
use App\Interfaces\Models\Loggable;
use App\Interfaces\Models\Sortable;
use App\Scopes\ArrayAttributeScope;
use App\Traits\Models\CreateCodeFromName;
use App\Traits\Models\SoftDeletes;
use App\Traits\Models\WithActiveAttribute;
use App\Traits\Models\WithMeta;
use App\Traits\Models\WithSortAttribute;
use App\Traits\Models\WithUserAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;

class Cemetery extends Model implements Sortable, Activatable, Loggable, HasPublicPage, HasMetaData
{
  use HasFactory;
  use WithUserAttributes;
  use SoftDeletes;
  use WithActiveAttribute;
  use WithSortAttribute;
  use WithMeta;
  use OrderableModel;
  use CreateCodeFromName;

  protected $keyType = 'string';

  protected $guarded = ['id'];

  protected $casts = [
    'phones' => PhoneArrayCast::class,
    'coordinates' => 'array'
  ];

  protected static function booted(): void
  {
    static::addGlobalScope(new ArrayAttributeScope());
  }

  public function getLinkAttribute(): string
  {
    return route('contacts.cemetery', $this->code);
  }

  public function getMapAttribute(): Map
  {
    return new Map($this->coordinates);
  }
}
