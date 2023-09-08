<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class BannerFanTypeFactory extends Factory
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
      'banner_id' => self::$order++,
      'fan_type_name_en_id' => $this->faker->randomElement([2, 3, 4, 7, 9, 14])
    ];
  }
}
