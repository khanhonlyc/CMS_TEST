<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UniformRegistration;
class UniformRegistrationFactory extends Factory
{
    protected $model = UniformRegistration::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amcno'    => $this->faker->text(10),
            'name'    => $this->faker->text(10),
            'uniformnum'    => $this->faker->numberBetween(1, 30),
            'created_at'    => $this->faker->dateTime(),
            'updated_at'    => $this->faker->dateTime()
        ];
    }
}
