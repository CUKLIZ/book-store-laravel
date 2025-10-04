<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua ID kategori
        $categoryIds = Category::pluck("id")->toArray();

        Product::factory(100)->create([
            'category_id' => function() use ($categoryIds) {
                return $categoryIds[array_rand($categoryIds)];
            },
        ]);
    }
}
