<?php


namespace App\Mixins;


use Closure;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\PostgresGrammar;
use Illuminate\Support\Fluent;

/** @mixin PostgresGrammar */
class PostgresGrammarMixin
{
  public function typeStringArray(): Closure
  {
    return fn(Fluent $column): string => 'varchar[]';
  }

  public function compileSoftUnique(): Closure
  {
    return function (Blueprint $blueprint, Fluent $command): string {
      return sprintf(
        'create unique index %s on %s (%s) where %s is null',
        $this->wrap($command->index),
        $this->wrapTable($blueprint),
        $this->columnize($command->columns),
        $this->wrap('deleted_at')
      );
    };
  }

  public function compileDropSoftUnique(): Closure
  {
    return function (Blueprint $blueprint, Fluent $command): string {
      return $this->compileDropIndex($blueprint, $command);
    };
  }

  public function compileDropSoftIndex(): Closure
  {
    return function (Blueprint $blueprint, Fluent $command): string {
      return $this->compileDropIndex($blueprint, $command);
    };
  }


  public function compileSoftIndex(): Closure
  {
    return function (Blueprint $blueprint, Fluent $command): string {
      return sprintf(
        'create index %s on %s (%s) where %s is null',
        $this->wrap($command->index),
        $this->wrapTable($blueprint),
        $this->columnize($command->columns),
        $this->wrap('deleted_at')
      );
    };
  }
}
