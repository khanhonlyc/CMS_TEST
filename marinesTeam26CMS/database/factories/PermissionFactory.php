<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Permission;
class PermissionFactory extends Factory
{
  protected $model = Permission::class;
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $number = $this->faker->unique()->randomElement([1, 2, 3]);
    $text = "";
    switch ($number) {
      case 1:
        $text = "管理者";
        break;
      case 2:
        $text = "マイページ運用担当";
        break;
      case 3:
        $text = "動画運用担当";
        break;
    }
    return [
      'permission_id' => $number,
      'permission_name' => $text,
      'created_at' => $this->faker->dateTime(),
      'create_user' => $this->faker->firstName(10),
      'deleted_at' => $this->faker->dateTime(),
      'delete_user' => $this->faker->firstName(10)
    ];
  }
}
