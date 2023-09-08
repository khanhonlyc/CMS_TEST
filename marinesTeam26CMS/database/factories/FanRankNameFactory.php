<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FanTypeNameEn;
class FanTypeNameEnFactory extends Factory
{
  protected $model = FanTypeNameEn::class;
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $number = $this->faker->randomElement([2, 3, 4, 7, 9, 14]);
    $text = $text2 = "";
    switch ($number) {
      case 2:
        $text = "ゴールド";
        $text2 = "GOLD";
        break;
      case 3:
        $text = "レギュラー";
        $text2 = "REGULAR";
        break;
      case 4:
        $text = "ジュニア";
        $text2 = "JUNIOR";
        break;
      case 7:
        $text = "カジュアルレギュラー";
        $text2 = "CASUAL REGULAR";
        break;
      case 9:
        $text = "無料";
        $text2 = "FREE";
        break;
      case 14:
        $text = "アカデミー";
        $text2 = "ACADEMY";
        break;
    }
    return [
      'fantypecode' => $number,
      'fantypename' => $text,
      'fantypenameen' => $text2,
      'created_at' => $this->faker->dateTime(),
      'create_user' => $this->faker->name(),
      'updated_at' => $this->faker->dateTime(),
      'update_user' => $this->faker->name(),
      'deleted_at' => $this->faker->dateTime(),
      'delete_user' => $this->faker->name()
    ];
  }
}
