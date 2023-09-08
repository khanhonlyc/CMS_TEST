<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ViewedMessage;
class ViewedMessageFactory extends Factory
{
    protected $model = ViewedMessage::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amcno'    => $this->faker->text(10),
            'messageid'    => $this->faker->unique()->numberBetween(1, 30),
            'created_at'    => $this->faker->dateTime()
        ];
    }
}
