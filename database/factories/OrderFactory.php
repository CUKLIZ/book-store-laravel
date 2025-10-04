<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_code' => 'QRD-' . $this->faker->unique()->randomFLoat(2, 10000, 99999),
            'total_price' => $this->faker->randomFloat(2, 50000, 1000000),
            'status' => $this->faker->randomElement(['pending', 'paid', 'shipped', 'completed', 'cancelled']),
            'payment_method' => $this->faker->randomElement(['credit_card', 'bank_transfer', 'e_wallet', 'cod']),
            'payment_status' => $this->faker->randomElement(['unpaid','paid']),
        ];
    }
}
