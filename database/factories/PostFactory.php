<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realTextBetween(10, 20),
            'subtitle' => $this->faker->realTextBetween(20, 30),
            'preview' => $this->faker->realTextBetween(160, 200),
            'text' => $this->faker->realTextBetween(160, 1000),
            'author_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
