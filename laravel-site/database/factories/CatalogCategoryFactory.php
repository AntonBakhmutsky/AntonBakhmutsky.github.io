<?php

namespace Database\Factories;

use App\Models\CatalogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class CatalogCategoryFactory extends Factory
{
  /**
   * @var string
   */
  protected $model = CatalogCategory::class;

  public function definition()
  {
    return [
      'name' => Str::ucfirst($this->faker->words(2, true)),
      'active' => true,
      'sort' => $this->faker->numberBetween(0, 1000),
      'image' => $this->faker->imageUrl(),
      'html' => $this->faker->text(500),
      'preview' => $this->faker->text(),
      'code' => $this->faker->unique()->word,
      'page_size' => $this->faker->numberBetween(2, 20),
      'text_position' => $this->faker->randomElement([CatalogCategory::TEXT_TOP_POSITION, CatalogCategory::TEXT_BOTTOM_POSITION]),
      'type' => $this->faker->randomElement([CatalogCategory::TYPE_TABBED, CatalogCategory::TYPE_VERTICAL, CatalogCategory::TYPE_HORIZONTAL]),
      'show_on_home' => $this->faker->boolean
    ];
  }

  public function child(): CatalogCategoryFactory
  {
    return $this->state(
      function (array $attributes) {
        $parent = CatalogCategory::active()->inRandomOrder()->firstOr(['id'], fn() => null);
        return [
          'parent_id' => optional($parent)->id
        ];
      }
    );
  }
}
