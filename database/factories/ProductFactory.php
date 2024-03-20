<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\DatabaseEnum\ProductTable;
use App\Enums\ImageEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            ProductTable::CODE => $this->faker->unique()->numberBetween(100,1000),
            ProductTable::NAME => $this->faker->name,
            ProductTable::DESCRIPTION => $this->faker->realText(),
            ProductTable::MRP => $this->faker->numberBetween(1000,2000),
            ProductTable::COST => $this->faker->numberBetween(100,1000),
            ProductTable::IMAGE => ImageEnum::NO_PRODUCT_IMAGE,
            ProductTable::CATEGORIES => Categories::inRandomOrder()->first()->id,
            ProductTable::UNIT => 1,
            ProductTable::FINANCE_YEAR => 1,
        ];
    }
}
