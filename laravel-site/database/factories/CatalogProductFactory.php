<?php

namespace Database\Factories;

use App\Models\CatalogCategory;
use App\Models\CatalogProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class CatalogProductFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = CatalogProduct::class;

    public function definition(): array
    {
        return [
          'name' => Str::ucfirst($this->faker->words(2, true)),
          'active' => true,
          'sort' => $this->faker->numberBetween(0, 1000),
          'image' => $this->faker->imageUrl(),
          'html' => $this->faker->text(),
          'code' => $this->faker->randomElement([null, $this->faker->unique()->word]),
          'vendor_code' => $this->faker->randomElement([null, $this->faker->word]),
          'price' => $this->faker->randomFloat(2, 0, 1000),
          'more_images' => [$this->faker->imageUrl()],
          'show_on_home' => $this->faker->boolean
        ];
    }
}
