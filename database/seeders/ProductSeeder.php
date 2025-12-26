<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'iPhone 15', 'price' => 1200.00, 'stock_quantity' => 10],
            ['name' => 'Samsung Galaxy S23', 'price' => 1000.00, 'stock_quantity' => 15],
            ['name' => 'MacBook Pro', 'price' => 2500.00, 'stock_quantity' => 5],
            ['name' => 'Dell XPS 13', 'price' => 1800.00, 'stock_quantity' => 8],
            ['name' => 'PlayStation 5', 'price' => 500.00, 'stock_quantity' => 20],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
