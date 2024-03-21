<?php

namespace Database\Factories;

use App\Enums\DatabaseEnum\PurchaseItemTable;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseItem>
 */
class PurchaseItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        return [
            // PurchaseItemTable::PURCHASE_ID,
            PurchaseItemTable::PRODUCT_ID => $product->id ,
            PurchaseItemTable::MRP => $product->mrp,
            PurchaseItemTable::COST => $product->cost,
            PurchaseItemTable::QUANTITY => $this->faker->numberBetween(1,50),
            PurchaseItemTable::FINANCE_YEAR => 1
        ];
    }
}
