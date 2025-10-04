<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Log;
use App\Models\User;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            Log::factory()->create([
                'user_id' => $userIds[array_rand($userIds)],
            ]);
        }
    }
}
