<?php

namespace Database\Factories;

use App\Enums\DatabaseEnum\StockTable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            StockTable::QUANTITY => 0,
            StockTable::FINANCE_YEAR => 1
        ];
    }
}
