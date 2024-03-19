<?php

namespace Database\Factories;

use App\Models\FinanceYears;
use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\DatabaseEnum\StudentTable;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            StudentTable::NAME => fake()->firstName(),
            StudentTable::ENROLMENT_NO => fake()->unique()->phoneNumber(),
            StudentTable::FATHER => fake()->firstName(),
            StudentTable::REMARK => fake()->realText(),
            StudentTable::FINANCE_YEAR => 1,
            StudentTable::CLASSES => StudentClass::inRandomOrder()->first()->id,
        ];
    }
}
