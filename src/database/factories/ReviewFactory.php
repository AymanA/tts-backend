<?php

namespace Database\Factories;

use App\Models\Hotel;
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
            'hotel_id' => Hotel::inRandomOrder()->first(),
            'score' => $this->faker->randomFloat(2, 0, 100),
            'comment' => $this->faker->text(),
            'created_date' => $this->faker->dateTimeBetween('-2 years', 'now')
        ];
    }
}
