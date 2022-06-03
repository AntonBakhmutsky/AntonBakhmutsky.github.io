<?php


namespace App\Interfaces\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface Loggable
{
  public function created_user(): BelongsTo;

  public function updated_user(): BelongsTo;
}
