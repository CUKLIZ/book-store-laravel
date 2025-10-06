<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = [
            // Fiksi
            'Novel', 'Cerpen', 'Fantasi', 'Petualangan', 'Misteri / Thriller',
            'Horor', 'Romantis', 'Fiksi Ilmiah (Sci-Fi)', 'Drama', 'Fiksi Sejarah',

            // Non-Fiksi
            'Biografi & Autobiografi', 'Motivasi & Pengembangan Diri', 'Sejarah',
            'Politik & Sosial', 'Agama & Spiritual', 'Sains & Teknologi',
            'Psikologi', 'Pendidikan', 'Kesehatan & Gaya Hidup', 'Ekonomi & Bisnis',

            // Anak & Remaja
            'Buku Cerita Anak', 'Buku Bergambar', 'Buku Edukasi Anak',
            'Komik / Manga', 'Teenlit / Young Adult',

            // Akademik & Referensi
            'Buku Pelajaran Sekolah', 'Buku Kuliah / Akademik', 'Kamus & Ensiklopedia',
            'Buku Panduan / Manual', 'Jurnal & Penelitian',

            // Lain-lain
            'Buku Masak', 'Hobi & Kerajinan', 'Seni & Desain',
            'Buku Perjalanan (Travel)', 'Puisi & Sastra', 'Majalah', 'Buku Keagamaan',
        ];

        foreach ($categoryNames as $name) {
            Category::create([
                'name' => $name,
                'slug' => \Illuminate\Support\Str::slug($name),
            ]);
        }
    }
}
