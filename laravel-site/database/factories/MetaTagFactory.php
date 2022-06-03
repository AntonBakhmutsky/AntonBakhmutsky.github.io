<?php

namespace Database\Factories;

use App\Models\MetaTag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class MetaTagFactory extends Factory
{
  /**
   * @var string
   */
  protected $model = MetaTag::class;

  public function definition(): array
  {
    return [
      'title' => Str::ucfirst($this->faker->word),
      'h1' => Str::ucfirst($this->faker->word),
      'keywords' => $this->faker->words(3, true),
      'description' => $this->faker->text,
      'image' => $this->faker->imageUrl(),
    ];
  }
}
