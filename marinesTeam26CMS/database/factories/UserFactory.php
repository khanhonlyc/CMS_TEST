<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class UserFactory extends Factory
{
  private static $order = 1;
  private static $user = 1;
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $number = self::$order++;
    switch ($number) {
      case 1:
        $email = "cms1admin@gmail.com";
        $name = "Supper Admin";
        $permission = 1;
        break;
      case 2:
        $email = "cms2admin@gmail.com";
        $name = "Manger";
        $permission = 2;
        break;
      case 3:
        $email = "cms3admin@gmail.com";
        $name = "User";
        $permission = 3;
        break;
      default:
        $email = $this->faker->email();
        $name = $this->faker->name();
        $permission = $this->faker->numberBetween(1, 3);
        break;
    }
    return [
      'sort_no' => $number,
      'user_id' => $email,
      'password' => '$2y$10$IQBK8xIQVlncnsp0.V4XnOhigJSSi8GuEV8Kg69M8FPIbZ5LzaFWK',
      // 12345678
      'user_name' => $name,
      'permission' => $permission,
      'created_at' => $this->faker->dateTime(),
      'create_user' => $this->faker->name(),
      'updated_at' => $this->faker->dateTime(),
      'update_user' => $this->faker->name(),
      'deleted_at' => null,
      'delete_user' => $this->faker->name()
    ];
  }
  /**
   * Indicate that the model's email address should be unverified.
   *
   * @return \Illuminate\Database\Eloquent\Factories\Factory
   */
  public function unverified()
  {
    return $this->state(function (array $attributes) {
      return [
        'email_verified_at' => null,
      ];
    });
  }
}
