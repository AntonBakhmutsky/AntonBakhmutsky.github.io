<?php

namespace Database\Factories;

use App\Models\Promotion;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class PromotionFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Promotion::class;

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
          'date_from' => $this->faker->randomElement([null, $this->faker->dateTimeBetween('-1 month', '+1 week')]),
          'date_to' => function (array $attributes): ?DateTime {
            return $this->faker->randomElement([null, $this->faker->dateTimeBetween($attributes['date_from'], '+2 weeks')]);
          }
        ];
    }
}
