<?php

namespace Database\Factories;

use App\Models\Cemetery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class CemeteryFactory extends Factory
{
  /**
   * @var string
   */
  protected $model = Cemetery::class;

  public function definition(): array
  {
    return [
      'name' => Str::ucfirst($this->faker->words(2, true)),
      'active' => true,
      'sort' => $this->faker->numberBetween(0, 1000),
      'html' => $this->faker->text(),
      'schedule' => $this->faker->text(),
      'address' => $this->faker->text(),
      'code' => $this->faker->unique()->word,
      'phones' => [$this->faker->phoneNumber],
      'coordinates' => [$this->faker->randomFloat(8, -90, 90), $this->faker->randomFloat(8, -180, 180)],
    ];
  }
}
