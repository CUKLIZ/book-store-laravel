<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        return [
            'category_id' => \App\Models\Category::factory(),
            'name' => $name,
            'slug' => \Str::slug($name),
            'author' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2,10000, 1000000),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => null,
        ];
    }
}
