<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        // Untuk Mengacak Orderer dan Order Items
        Order::factory(30)->create([
            'user_id' => function () use ($userIds) {
                return $userIds[array_rand($userIds)];
            },
        ])->each(function ($order) use ($productIds) {
            // Setiap order punya 1-5 item
            for ($i = 0; $i < rand(1, 5); $i++) {
                $product = Product::find($productIds[array_rand($productIds)]);
                $quantity = rand(1, 3);
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $product->price * $quantity,
                ]);
            }

            // $order->refresh();
            // $order->refresh();
            $order->load('items');
            $order->total_price = $order->items->sum('subtotal');
            $order->save();

        });
    }
}
