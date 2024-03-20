<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\DatabaseEnum\SupplierTable;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            SupplierTable::NAME => $this->faker->name(),
            SupplierTable::PHONE =>$this->faker->phoneNumber(),
            SupplierTable::EMAIL => $this->faker->email(),
            SupplierTable::ADDRESS => $this->faker->address(),
            SupplierTable::CITY => $this->faker->city(),
            SupplierTable::STATE => $this->faker->city(),
            SupplierTable::COUNTRY =>$this->faker->country(),
            SupplierTable::POSTAL_CODE => $this->faker->postcode(),
            SupplierTable::FINANCE_YEAR => 1,
        ];
    }
}
