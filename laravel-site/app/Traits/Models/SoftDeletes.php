<?php


namespace App\Traits\Models;


use Auth;

trait SoftDeletes
{
  use \Illuminate\Database\Eloquent\SoftDeletes {
    \Illuminate\Database\Eloquent\SoftDeletes::bootSoftDeletes as parentBootSoftDeletes;
  }

  public function initializeSoftDeletes(): void
  {
    $this->mergeGuarded([$this->getDeletedAtColumn(), 'deleted_by']);
  }

  public static function bootSoftDeletes(): void
  {
    static::parentBootSoftDeletes();

    static::deleting(
      function (self $model) {
        $model->deleted_by = Auth::check() ? Auth::id() : null;
      }
    );

    static::restoring(
      function (self $model) {
        $model->deleted_by = null;
      }
    );
  }

  /**
   * Perform the actual delete query on this model instance.
   *
   */
  protected function runSoftDelete()
  {
    $query = $this->setKeysForSaveQuery($this->newModelQuery());

    $time = $this->freshTimestamp();

    $columns = [
      $this->getDeletedAtColumn() => $this->fromDateTime($time)
    ];

    $this->{$this->getDeletedAtColumn()} = $time;

    /**
     * Add changes from observer here,
     * overrides $columns, but leaves timestamps in tact
     */
    $columns = array_merge($query->getModel()->getDirty(), $columns);

    $query->update($columns);

    $this->syncOriginalAttributes(array_keys($columns));
  }

}
