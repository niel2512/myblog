<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
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
        $title = fake()->sentence(rand(6, 8));
        return [
            'title' => $title,
            'author_id' => User::factory(), //relasi ke model user
            'category_id' => Category::factory(), //relasi ke model category
            'slug' => Str::slug($title),
            'body' => fake()->text()
        ];
    }
}
