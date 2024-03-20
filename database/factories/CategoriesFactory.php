<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\DatabaseEnum\CategoriesTable;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categories>
 */
class CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            CategoriesTable::NAME => $this->faker->name,
            CategoriesTable::DESCRIPTION => $this->faker->sentence,
            CategoriesTable::FINANCE_YEAR => 1
        ];
    }
}
