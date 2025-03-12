<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = [
            ['name' => 'Vitamin C Serum', 'price' => 1200, 'stock' => 50, 'category' => 'skincare', 'discount' => 100, 'image' => 'vitamin-c-serum.jpg', 'description' => 'Brightens and hydrates your skin.'],
            ['name' => 'Hydrating Moisturizer', 'price' => 1500, 'stock' => 30, 'category' => 'skincare', 'discount' => 200, 'image' => 'moisturizer.jpg', 'description' => 'Deeply nourishes your skin.'],
            ['name' => 'Matte Lipstick', 'price' => 900, 'stock' => 40, 'category' => 'makeup', 'discount' => 50, 'image' => 'lipstick.jpg', 'description' => 'Long-lasting matte finish.'],
            ['name' => 'Foundation', 'price' => 1800, 'stock' => 20, 'category' => 'makeup', 'discount' => 150, 'image' => 'foundation.jpg', 'description' => 'Smooth and flawless coverage.'],
            ['name' => 'Body Lotion', 'price' => 800, 'stock' => 60, 'category' => 'bodycare', 'discount' => 100, 'image' => 'body-lotion.jpg', 'description' => 'Softens and nourishes skin.'],
            ['name' => 'Coffee ScrSSub', 'price' => 700, 'stock' => 35, 'category' => 'scrub', 'discount' => 80, 'image' => 'coffee-scrub.jpg', 'description' => 'Removes dead skin cells and smoothens skin.'],
            ['name' => 'Charcoal Face Scrub', 'price' => 950, 'stock' => 25, 'category' => 'scrub', 'discount' => 70, 'image' => 'charcoal-scrub.jpg', 'description' => 'Purifies and deep cleanses the skin.'],
            ['name' => 'Shampoo', 'price' => 1100, 'stock' => 45, 'category' => 'haircare', 'discount' => 120, 'image' => 'shampoo.jpg', 'description' => 'Strengthens and protects hair.'],
            ['name' => 'Hair Serum', 'price' => 1300, 'stock' => 30, 'category' => 'haircare', 'discount' => 150, 'image' => 'hair-serum.jpg', 'description' => 'Reduces frizz and adds shine.'],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'category' => $product['category'],
                'discount' => $product['discount'],
                'image' => $product['image'],
                'description' => $product['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
