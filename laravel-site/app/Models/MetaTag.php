<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
  use HasFactory;

  protected $keyType = 'string';

  protected $primaryKey = 'item_id';

  public $incrementing = false;

  public $timestamps = false;
}
