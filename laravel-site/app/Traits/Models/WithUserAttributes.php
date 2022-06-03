<?php


namespace App\Traits\Models;

use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait WithUserAttributes
{
  public function initializeWithUserAttributes(): void
  {
    $this->mergeGuarded(['created_at', 'created_by', 'updated_at', 'updated_by']);
  }

  public static function bootWithUserAttributes(): void
  {
    static::creating(
      function (self $model) {
        $model->created_by = Auth::check() ? Auth::id() : null;
        $model->updated_by = $model->created_by;
      }
    );
    static::updating(
      function (self $model) {
        $model->updated_by = Auth::check() ? Auth::id() : null;
      }
    );
  }

  public function created_user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'created_by', 'id');
  }

  public function updated_user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'updated_by', 'id');
  }

}
