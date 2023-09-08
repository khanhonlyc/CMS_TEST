<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Manager;
class ManagerFactory extends Factory
{
  protected $model = Manager::class;
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'sort_no' => $this->faker->numberBetween(1, 30),
      'user_id' => $this->faker->numberBetween(1, 30),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'user_name' => $this->faker->name(),
      'permission' => $this->faker->randomElement(['subscriber', 'contributor','author','editor','administrator']),
      'created_at' => $this->faker->dateTime(),
      'create_user' => $this->faker->firstName(),
      'updated_at' => $this->faker->dateTime(),
      'update_user' => $this->faker->name(),
      'deleted_at' =>$this->faker->dateTime(),
      'delete_user' => $this->faker->firstName()
    ];
  }
}
