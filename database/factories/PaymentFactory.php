<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'payment_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'amount' => $this->faker->randomFloat(2, 10000, 99999),
            'payment_method' => $this->faker->randomElement(['credit_card', 'bank_transfer', 'e_wallet', 'cod']),
            'payment_proof' => 'https://picsum.photos/640/480?random=' . $this->faker->numberBetween(101,200), // Placeholder image
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
        ];
    }
}
