<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sender_id' => $this->faker->numberBetween($min = 1, $max = 20),
            'receiver_id' => $this->faker->numberBetween($min = 1, $max = 20),
            'created_at' => $this->faker->dateTimeThisYear($max = 'now'),
            'title' => $this->faker->text($minNbChars = 5, $maxNbChars = 150),
            'content' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
