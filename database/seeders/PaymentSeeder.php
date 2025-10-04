<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ordersIds = Order::where('payment_status', 'paid')->pluck('id')->toArray();
        
        foreach($ordersIds as $orderId) {
            $order = Order::find($orderId);
            Payment::factory()->create([
                'order_id' => $order->id,
                'amount' => $order->total_price,
                'payment_method' => rand(0, 1) ? 'credit_card' : 'bank_transfer',
                'payment_date' => now(),
                // 'payment_proof' => 'proof_' . $order->id . '.jpg',
                'status' => 'completed',
            ]);
        }
    }
}
