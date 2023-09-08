<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class PlayerUniformFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'playerCode' => $this->faker->name(),
      'playerUniformNo' => $this->faker->name(),
      'player' => $this->faker->name(),
      'playerName' => $this->faker->name(),
      'created_at' => $this->faker->dateTime(),
      'updated_at' => $this->faker->dateTime()
    ];
  }
}
