<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class TagFactory extends Factory
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
      'tag_id' => self::$order++,
      'tag_name' => $this->faker->text(10),
      'created_at' => $this->faker->dateTime(),
      'create_user' => $this->faker->name(),
      'updated_at' => $this->faker->dateTime(),
      'update_user' => $this->faker->name(),
      'deleted_at' => null,
      'delete_user' => $this->faker->name()
    ];
  }
}
