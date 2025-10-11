<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Genre;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua ID kategori
        $categoryIds = Category::pluck('id')->toArray();
        $genreIds = Genre::pluck('id')->toArray();

        // Cek jika genre kosong (Jika GenreSeeder gagal atau belum dijalankan)
        if (empty($genreIds)) {
            $this->command->info('Tidak ada Genre yang ditemukan. Harap pastikan GenreSeeder telah berjalan.');

            return;
        }

        // 1. Buat 100 produk
        Product::factory(100)
            ->create([
                'category_id' => function () use ($categoryIds) {
                    // Gunakan ID kategori acak
                    return $categoryIds[array_rand($categoryIds)];
                },
            ])
            ->each(function (Product $product) use ($genreIds) {
                // 2. Hubungkan setiap produk dengan genre secara acak

                // Tentukan jumlah genre (minimal 1, maksimal 3, atau maksimal jumlah genre yang tersedia)
                $maxGenres = min(3, count($genreIds));
                $numberOfGenres = rand(1, $maxGenres);

                // Ambil sejumlah ID genre secara acak
                $randomKeys = (array) array_rand($genreIds, $numberOfGenres);

                // Pastikan $randomKeys selalu array berisi kunci atau ID tunggal
                if (! is_array($randomKeys)) {
                    $randomKeys = [$randomKeys];
                }

                $attachedGenreIds = array_map(function ($key) use ($genreIds) {
                    return $genreIds[$key];
                }, $randomKeys);

                // Sinkronisasi/Pasang ID genre ke produk melalui tabel pivot
                $product->genres()->attach($attachedGenreIds);
            });
    }
}
