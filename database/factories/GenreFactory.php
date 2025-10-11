<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        // Mapping kategori berdasarkan kata kunci (lebih fleksibel)
        $fictionKeywords = ['novel', 'fantasi', 'misteri', 'thriller', 'cerpen', 'fiksi'];
        $nonFictionKeywords = ['motivasi', 'pengembangan', 'sejarah', 'agama', 'biografi', 'politik', 'bisnis'];

        // Cari kategori Fiksi secara dinamis
        $fictionCategory = Category::where(function ($query) use ($fictionKeywords) {
            foreach ($fictionKeywords as $keyword) {
                $query->orWhere('slug', 'LIKE', '%' . $keyword . '%');
            }
        })->first();

        // Cari kategori Non-Fiksi secara dinamis
        $nonFictionCategory = Category::where(function ($query) use ($nonFictionKeywords) {
            foreach ($nonFictionKeywords as $keyword) {
                $query->orWhere('slug', 'LIKE', '%' . $keyword . '%');
            }
        })->first();

        // Jika kategori tidak ditemukan, tetap lanjut tanpa error fatal
        if (!$fictionCategory) {
            $this->command->warn('⚠️ Kategori Fiksi tidak ditemukan, Genre Fiksi dilewati.');
        } else {
            $this->command->info('✅ Kategori Fiksi ditemukan: ' . $fictionCategory->name);
        }

        if (!$nonFictionCategory) {
            $this->command->warn('⚠️ Kategori Non-Fiksi tidak ditemukan, Genre Non-Fiksi dilewati.');
        } else {
            $this->command->info('✅ Kategori Non-Fiksi ditemukan: ' . $nonFictionCategory->name);
        }

        // Genre Fiksi
        $fictionGenres = ['Fantasi Epik', 'Romantis Kontemporer', 'Fiksi Kriminal', 'Sci-Fi Post-Apocalyptic', 'Horor Gotik', 'Thriller Psikologis'];

        // Genre Non-Fiksi
        $nonFictionGenres = ['Biografi Politik', 'Panduan Karir', 'Sejarah Kuno', 'Studi Islam', 'Psikologi Terapan', 'Bisnis Startup'];

        // Insert Genre Fiksi kalau kategori ditemukan
        if ($fictionCategory) {
            foreach ($fictionGenres as $name) {
                Genre::create([
                    'category_id' => $fictionCategory->id,
                    'name' => $name,
                    'slug' => Str::slug($name),
                ]);
            }
        }

        // Insert Genre Non-Fiksi kalau kategori ditemukan
        if ($nonFictionCategory) {
            foreach ($nonFictionGenres as $name) {
                Genre::create([
                    'category_id' => $nonFictionCategory->id,
                    'name' => $name,
                    'slug' => Str::slug($name),
                ]);
            }
        }
    }
}
