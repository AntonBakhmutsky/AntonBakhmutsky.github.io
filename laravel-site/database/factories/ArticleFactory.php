<?php

namespace Database\Factories;

use App\Models\Article;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class ArticleFactory extends Factory
{
  /**
   * @var string
   */
  protected $model = Article::class;

  public function definition(): array
  {
    return [
      'name' => Str::ucfirst($this->faker->words(2, true)),
      'active' => true,
      'sort' => $this->faker->numberBetween(0, 1000),
      'image' => $this->faker->imageUrl(),
      'html' => $this->faker->text(),
      'preview' => $this->faker->text(),
      'code' => $this->faker->unique()->word,
      'show_on_home' => $this->faker->boolean,
      'type' => $this->faker->randomElement([Article::PREVIEW_HORIZONTAL_TYPE, Article::PREVIEW_VERTICAL_TYPE]),
      'active_from' => $this->faker->randomElement([null, $this->faker->dateTimeBetween('-1 month', '+1 week')]),
      'active_to' => function (array $attributes): ?DateTime {
        return $this->faker->randomElement([null, $this->faker->dateTimeBetween($attributes['active_from'], '+2 weeks')]);
      }
    ];
  }
}
