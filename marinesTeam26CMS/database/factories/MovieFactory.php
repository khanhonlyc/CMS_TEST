<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Movie;
class MovieFactory extends Factory
{
  protected $model = Movie::class;
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'movie_type_code' => $this->faker->randomElement([1,2]),
      'sort_no' => $this->faker->numberBetween(1, 30),
      'title' => $this->faker->text(10),
      'thumbnail_url' => $this->faker->imageUrl(),
      'sauce' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/DbjzJQnrQto" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
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
