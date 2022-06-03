<?php

namespace App\Models;

use App\Interfaces\Models\Loggable;
use App\Traits\Models\SoftDeletes;
use App\Traits\Models\WithUserAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model implements Loggable
{
  use HasFactory;
  use WithUserAttributes;
  use SoftDeletes;

  public const CACHE_TTL = 86400;
  public const CACHE_KEY = 'settings';

  protected $primaryKey = 'code';
  protected $keyType = 'string';
  public $incrementing = false;

  public const TYPE_TEXT = 'text';
  public const TYPE_STRING = 'string';
  public const TYPE_BOOL = 'bool';
}
