<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'caption' => $this->faker->sentence(),
            'image_path' => 'https://placehold.co/470x600',
            'views' => $this->faker->numberBetween(0, 1000),
            'shares_count' => $this->faker->numberBetween(0, 500),
            'views_count' => $this->faker->numberBetween(0, 1000),
            'reported_count' => $this->faker->numberBetween(0, 50),
            'reactions_count' => $this->faker->numberBetween(0, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
