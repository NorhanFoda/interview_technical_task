<?php

namespace Database\Seeders;

use App\Models\Order;
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
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        // Create 20 orders
        Order::factory(20)->make()->each(function ($order) use ($users, $products) {
            $order->user_id = $users->random()->id;
            $order->save();

            // Add 1-5 items to each order
            $numItems = rand(1, 5);
            $totalAmount = 0;

            for ($i = 0; $i < $numItems; $i++) {
                $product = $products->random();
                $quantity = rand(1, 3);
                $price = $product->price;

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                $totalAmount += $quantity * $price;
            }

            $order->update(['total_amount' => $totalAmount]);
        });
    }
}
