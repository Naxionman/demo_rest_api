<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;

class CourseFactory extends Factory
{
      protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(5, true),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['Published', 'Pending']),
            'is_premium' => $this->faker->boolean(50),
            'created_at' => $this->faker->dateTimeThisDecade(),
            'deleted_at' => $this->faker->optional(0.1)->dateTimeThisDecade(),
        ];
    }
}
