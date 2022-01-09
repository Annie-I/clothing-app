<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 20),
            'name' => $this->faker->text($maxNbChars = 100),
            'price' => $this->faker->numberBetween($min = 0, $max = 10000),
            'state_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'image_path' => 'public/test-images/'.$this->faker->numberBetween($min = 1, $max = 10).'.jpg',
            'description' => $this->faker->text($minNbChars = 10, $maxNbChars = 2500),
            'category_id' => $this->faker->numberBetween($min = 1, $max = 19),
        ];
    }
}
