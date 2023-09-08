<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Banner;
class BannerFactory extends Factory
{
  protected $model = Banner::class;
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'banner_type_code' => $this->faker->randomElement([1,2,3,4,5]),
      'sort_no' => $this->faker->numberBetween(1, 30),
      'title' => $this->faker->text(10),
      'image_url' => $this->faker->imageUrl(),
      'url' => $this->faker->url(),
      'target' => $this->faker->randomElement([0,1]),
      'fan_type_code' => $this->faker->randomElement([2,3,4,7,9,14]),
      'publish_start' => $this->faker->dateTime(),
      'publish_end' => $this->faker->dateTime(),
      'status' => $this->faker->randomElement([0, 1]),
      'created_at' => $this->faker->dateTime(),
      'create_user' => $this->faker->name(),
      'updated_at' => $this->faker->dateTime(),
      'update_user' => $this->faker->name(),
      'deleted_at' => null,
      'delete_user' => $this->faker->name()
    ];
  }
}
