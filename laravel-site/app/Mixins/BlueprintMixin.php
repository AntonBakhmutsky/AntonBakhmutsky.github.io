<?php


namespace App\Mixins;


use Closure;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Fluent;

/** @mixin Blueprint */
class BlueprintMixin
{
  public function softUnique(): Closure
  {
    return function (array|string $columns, ?string $name = null): Fluent {
      return $this->indexCommand('softUnique', $columns, $name);
    };
  }

  public function dropSoftUnique(): Closure
  {
    return function (array|string $index): Fluent {
      return $this->dropIndexCommand('dropIndex', 'softUnique', $index);
    };
  }

  public function softIndex(): Closure
  {
    return function (array|string $columns, ?string $name = null): Fluent {
      return $this->indexCommand('softIndex', $columns, $name);
    };
  }

  public function dropSoftIndex(): Closure
  {
    return function (array|string $index): Fluent {
      return $this->dropIndexCommand('dropIndex', 'softIndex', $index);
    };
  }

  public function softDeletesWithUserAttributes(): Closure
  {
    return function (): void {
      $this->softDeletes();
      $this->unsignedSmallInteger('deleted_by')->nullable();
      $this->foreign('deleted_by')->references('id')->on('users')->onDelete('restrict');
    };
  }

  public function timestampsWithUserAttributes(): Closure
  {
    return function (): void {
      $this->timestamp('created_at')->useCurrent();
      $this->timestamp('updated_at')->useCurrent();
      $this->unsignedSmallInteger('created_by');
      $this->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
      $this->unsignedSmallInteger('updated_by');
      $this->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');
    };
  }

  public function active(): Closure
  {
    return function (): void {
      $this->boolean('active')->default(false);
    };
  }

  public function sort(): Closure
  {
    return function (): void {
      $this->unsignedSmallInteger('sort')->default(50);
    };
  }
}
