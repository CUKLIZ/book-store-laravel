<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Genre;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::pluck('id')->toArray();

        // Generate 100 produk
        Product::factory(100)->create([
            'category_id' => fn () => $categoryIds[array_rand($categoryIds)],
        ])->each(function (Product $product) {
            
            // Ambil genre berdasarkan kategori produk ini
            $relatedGenres = Genre::where('category_id', $product->category_id)->pluck('id')->toArray();

            // Kalau genre kosong untuk kategori ini → skip
            if (empty($relatedGenres)) {
                return;
            }

            // Tentukan jumlah genre (1–3) sesuai jumlah genre tersedia
            $maxGenres = min(3, count($relatedGenres));
            $numberOfGenres = rand(1, $maxGenres);

            // Ambil genre random sesuai kategori
            $randomGenreIds = collect($relatedGenres)->random($numberOfGenres)->toArray();

            // Attach ke pivot tanpa duplikat
            $product->genres()->syncWithoutDetaching($randomGenreIds);
        });
    }
}
