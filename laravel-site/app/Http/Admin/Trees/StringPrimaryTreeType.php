<?php


namespace App\Http\Admin\Trees;


use Illuminate\Database\Eloquent\Collection;
use SleepingOwl\Admin\Contracts\Display\Tree\TreeTypeInterface;
use SleepingOwl\Admin\Display\Tree\SimpleTreeType;

class StringPrimaryTreeType extends SimpleTreeType implements TreeTypeInterface
{
  /**
   * Get children for simple tree type structure.
   *
   * @param $collection
   * @param $id
   *
   * @return Collection
   */
  protected function getChildren($collection, $id)
  {
    $parentField = $this->repository->getParentField();
    $result = [];
    foreach ($collection as $instance) {
      if ((string) $instance->$parentField != $id) {
        continue;
      }

      $instance->setRelation(
        'children',
        $this->getChildren($collection, $instance->getKey())
      );

      $result[] = $instance;
    }

    return new Collection($result);
  }
}
