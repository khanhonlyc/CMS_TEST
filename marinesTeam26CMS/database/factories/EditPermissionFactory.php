<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EditPermission;
class EditPermissionFactory extends Factory
{
  protected $model = EditPermission::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'permission_id' => $this->faker->numberBetween(1, 30),
          'permission_name' => $this->faker->firstName(),
          'created_at' => $this->faker->dateTime(),
          'create_user' => $this->faker->firstName(10),
          'deleted_at' =>$this->faker->dateTime(),
          'delete_user' => $this->faker->firstName(10)
        ];
    }
}
