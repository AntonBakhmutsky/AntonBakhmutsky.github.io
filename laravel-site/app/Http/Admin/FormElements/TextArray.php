<?php


namespace App\Http\Admin\FormElements;



use Illuminate\Support\Collection;
use SleepingOwl\Admin\Form\Related\Forms\HasManyLocal;

class TextArray extends HasManyLocal
{
  protected function loadFieldValues(): void
  {
    $this->fieldValues = collect($this->getFieldValues());
  }

  protected function getRelatedValuesFromRequestData(array $values): Collection
  {
    $collection = collect();
    foreach (array_values($values) as $key => $attributes) {
      if ($key === static::REMOVE) {
        // If key is about to be removed we need to save it and show later in rendered form. But we don't
        // need to put value with this relation in collection of elements, that's why we need to continue the
        // loop
        $this->toRemove = collect($attributes);
        continue;
      }

      if (strpos($key, static::NEW_ITEM) !== false) {
        // If item is new, wee need to implement counter of new items to prevent duplicates,
        // check limits and etc.
        $this->new++;
      }

      // Finally, we put filled model values into collection of future groups
      $collection->put($key, $attributes);
    }

    return $collection;
  }
}
