<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Manual dulu kalau tahu cara otomatis nanti di bikin otomatis
        // 1. Dapatkan ID Kategori utama Fiksi dan Non-Fiksi.
        // Anda mungkin perlu menyesuaikan ini tergantung nama kategori yang Anda gunakan.
        $fictionCategory = Category::whereIn('slug', ['novel', 'fantasi', 'misteri-thriller'])->first();
        $nonFictionCategory = Category::whereIn('slug', ['motivasi-pengembangan-diri', 'sejarah', 'agama-spiritual'])->first();

        // Pastikan kategorinya ada
        if (! $fictionCategory || ! $nonFictionCategory) {
            $this->command->info('Pastikan CategorySeeder sudah dijalankan dan kategori Fiksi/Non-Fiksi ada.');

            return;
        }

        // 2. Daftar Genre Fiksi
        $fictionGenres = ['Fantasi Epik', 'Romantis Kontemporer', 'Fiksi Kriminal', 'Sci-Fi Post-Apocalyptic', 'Horor Gotik', 'Thriller Psikologis'];

        // 3. Daftar Genre Non-Fiksi
        $nonFictionGenres = ['Biografi Politik', 'Panduan Karir', 'Sejarah Kuno', 'Studi Islam', 'Psikologi Terapan', 'Bisnis Startup'];

        // 4. Proses Seeding Genre Fiksi
        foreach ($fictionGenres as $name) {
            Genre::create([
                'category_id' => $fictionCategory->id,
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

        // 5. Proses Seeding Genre Non-Fiksi
        foreach ($nonFictionGenres as $name) {
            Genre::create([
                'category_id' => $nonFictionCategory->id,
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

    }
}
