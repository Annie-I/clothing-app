<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rating' => $this->faker->numberBetween($min = 0, $max = 5),
            'user_id' => $this->faker->numberBetween($min = 6, $max = 20),
            'receiver_id' => 5,
            'review' => $this->faker->text($minNbChars = 5, $maxNbChars = 200),
            'created_at' => $this->faker->dateTimeThisYear($max = 'now'),
        ];
    }
}
