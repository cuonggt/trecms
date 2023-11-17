<?php

namespace Database\Factories;

use App\Models\User;
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
        $content = '';
        $paragraphs = $this->faker->paragraphs(3);
        foreach ($paragraphs as $paragraph) {
            $content .= "<p>{$paragraph}</p>";
        }

        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(),
            'excerpt' => $this->faker->paragraph(),
            'content' => $content,
            'status' => 'publish',
            'published_at' => now(),
        ];
    }
}
