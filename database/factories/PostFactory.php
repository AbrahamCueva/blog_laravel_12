<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

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
            'title' => $this->faker->sentence,
            'slug' => $this->faker->unique()->slug,
            'excerpt' => $this->faker->text(200),
            'content' => $this->faker->text(1000),
            'user_id' => 1,
            'category_id' => Category::all()->random()->id,
            // 'is_published' => true,
            // 'published_at' => now(),
        ];
    }
}
