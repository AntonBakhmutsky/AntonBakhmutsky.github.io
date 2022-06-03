<?php

namespace App\Models;

use App\Interfaces\Models\Loggable;
use App\Traits\Models\SoftDeletes;
use App\Traits\Models\WithUserAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Str;

class Request extends Model implements Loggable
{
  use HasFactory;
  use WithUserAttributes;
  use SoftDeletes;

  protected $guarded = ['id'];

  public const TYPE_CALL = 'call';
  public const TYPE_CONSULTATION = 'consultation';
  public const TYPE_ORDER = 'order';

  public const STATUS_NEW = 'new';
  public const STATUS_CLOSED = 'closed';
  public const STATUS_CANCELED = 'canceled';


  /**
   *  Format phone number to "8 (888) 888-88-88"
   */
  public function formatPhone(): void
  {
    $numbers = preg_replace('/[^\d]/', '', $this->phone);
    $formattedPhone = Str::substr($numbers, 0, 1) . ' (' . Str::substr($numbers, 1, 3) . ') ';
    $formattedPhone .= Str::substr($numbers, 4, 3) . '-' . Str::substr($numbers, 7, 2) . '-';
    $formattedPhone .= Str::substr($numbers, 9, 2);
    $this->phone = $formattedPhone;
  }

  public function product(): BelongsTo
  {
    return $this->belongsTo(CatalogProduct::class, 'product_id');
  }
}
