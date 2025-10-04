<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        for( $i = 0; $i < count( $userIds ); $i++ ) {
            $cartCount = rand(1, 5); // Setiap user bisa punya 1-5 item di cart
            $selectedProducts = (array)array_rand($productIds, $cartCount);

            foreach( $selectedProducts as $prodIndex ) {
                \DB::table('carts')->insert([
                    'user_id' => $userIds[$i],
                    'product_id' => $productIds[$prodIndex],
                    'quantity' => rand(1, 3), // Setiap item bisa punya quantity 1-3
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
