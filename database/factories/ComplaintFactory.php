<?php

namespace Database\Factories;

use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Complaint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 20),
            'subject_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'content' => $this->faker->text($minNbChars = 10, $maxNbChars = 200),
            'created_at' => $this->faker->dateTimeThisYear($max = 'now'),
            'status_id' => $this->faker->numberBetween($min = 1, $max = 3),
        ];
    }
}
