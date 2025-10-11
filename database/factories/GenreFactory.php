<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word() . 'Genre';
        return [
            // Setiap genre terkait dengan category
            'category_id' => \App\Models\Category::factory(),
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
        ];
    }
}
