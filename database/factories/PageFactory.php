<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pageable_type' => 'App\Models\Post',
            'pageable_id' => 1,
            'slug' => $this->faker->realTextBetween(10, 20),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
