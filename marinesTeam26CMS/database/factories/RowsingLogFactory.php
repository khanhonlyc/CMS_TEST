<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RowsingLog;
class RowsingLogFactory extends Factory
{
  protected $model = RowsingLog::class;
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'cookie' => '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', // test
      'session_id' => $this->faker->numberBetween(1, 30),
      'access_ip' => $this->faker->localIpv4(),
      'server' => $this->faker->macAddress(),
      'method' => $this->faker->randomElement(['GET', 'POST']),
      'user_agent' => $this->faker->userAgent(),
      'referer' => $this->faker->text(10),
      'request_url' => $this->faker->url(),
      'query_string' => $this->faker->text(10),
      'marines_id' => $this->faker->numberBetween(1, 30),
      'regist_dt' => $this->faker->dateTime()
    ];
  }
}
