<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Testing\Fluent\Concerns\Has;
use Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Password: password
            'role' => 'admin',
            'alamat' => 'Admin Address',
            'no_hp' => '1234567890',
            'profile_photo' => null,
            // 'remember_token' => Str::random(10),
        ]);

        User::factory(50)->create();
    }
}
