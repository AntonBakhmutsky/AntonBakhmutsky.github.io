<?php

namespace Database\Factories;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class MenuItemFactory extends Factory
{
  /**
   * @var string
   */
  protected $model = MenuItem::class;

  public function definition(): array
  {
    return [
      'name' => Str::ucfirst($this->faker->words(2, true)),
      'link' => $this->faker->url,
      'active' => true,
      'sort' => $this->faker->numberBetween(0, 1000),
      'type' => $this->faker->randomElement([MenuItem::TYPE_MAIN, MenuItem::TYPE_TOP, MenuItem::TYPE_BOTTOM])
    ];
  }

  public function child(): MenuItemFactory
  {
    return $this->state(
      function (array $attributes): array {
        $parent = MenuItem::active()->root()->whereType($attributes['type'])->inRandomOrder()->firstOr(['id'], fn() => null);
        return [
          'parent_id' => optional($parent)->id
        ];
      }
    );
  }
}
