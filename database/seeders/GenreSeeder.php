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
        // Mapping kategori → daftar genre 
        $genreGroups = [
            'novel' => ['Romance', 'Fantasi', 'Thriller Psikologis', 'Drama Kehidupan', 'Slice of Life', 'Mystery Detective'],
            'cerpen' => ['Cerpen Inspiratif', 'Cerpen Remaja', 'Cerpen Kehidupan'],
            'fantasi' => ['High Fantasy', 'Urban Fantasy', 'Dark Fantasy', 'Isekai'],
            'petualangan' => ['Adventure Survival', 'Exploration Quest'],
            'misteri-thriller' => ['Crime Thriller', 'Murder Mystery', 'Suspense Thriller'],
            'horor' => ['Horor Gotik', 'Horor Supranatural', 'Horor Psikologis'],
            'romantis' => ['Romantis Sekolah', 'Romantis Dewasa', 'Romantis Komedi'],
            'fiksi-ilmiah-sci-fi' => ['Cyberpunk', 'Space Opera', 'Time Travel'],
            'drama' => ['Drama Keluarga', 'Drama Persahabatan', 'Drama Realistis'],
            'fiksi-sejarah' => ['Historical Fiction', 'Alternate History'],

            // Non-Fiksi
            'biografi-autobiografi' => ['Biografi Tokoh Nasional', 'Biografi Inspiratif'],
            'motivasi-pengembangan-diri' => ['Self Improvement', 'Life Coaching', 'Mindset Positif'],
            'sejarah' => ['Sejarah Nusantara', 'Perang Dunia', 'Sejarah Peradaban'],
            'politik-sosial' => ['Politik Modern', 'Kajian Sosial'],
            'agama-spiritual' => ['Studi Islam', 'Renungan Harian', 'Spiritual Modern'],
            'sains-teknologi' => ['Teknologi Digital', 'Fisika Populer', 'Artificial Intelligence'],
            'psikologi' => ['Psikologi Klinis', 'Psikologi Populer', 'Mental Health'],
            'pendidikan' => ['Metode Belajar', 'Pendidikan Karakter'],
            'kesehatan-gaya-hidup' => ['Kesehatan Tubuh', 'Gaya Hidup Sehat'],
            'ekonomi-bisnis' => ['Bisnis Startup', 'Marketing Digital', 'Investasi'],
        ];

        // Proses insert genre berdasarkan kategori yang cocok
        foreach ($genreGroups as $categorySlug => $genres) {
            $category = Category::where('slug', $categorySlug)->first();

            if (! $category) {
                $this->command->warn("Kategori dengan slug '{$categorySlug}' tidak ditemukan. Skip...");
                continue;
            }

            foreach ($genres as $genreName) {
                Genre::updateOrCreate(
                    [
                        'name' => $genreName,
                        'category_id' => $category->id,
                    ],
                    [
                        'slug' => Str::slug($genreName),
                    ]
                );
            }
        }

        $this->command->info('✅ GenreSeeder selesai! Semua genre berhasil dimasukkan sesuai kategori.');
    }
}
