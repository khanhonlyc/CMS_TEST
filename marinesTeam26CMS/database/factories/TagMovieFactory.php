<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class TagMovieFactory extends Factory
{
  private static $order = 1;
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'tag_id' => $this->faker->numberBetween(1, 5),
      'movie_id' => self::$order++
    ];
  }
}
