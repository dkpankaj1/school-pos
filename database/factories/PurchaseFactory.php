<?php

namespace Database\Factories;

use App\Enums\DatabaseEnum\PurchaseTable;
use App\Enums\DiscountTypeEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            PurchaseTable::DATE => $this->faker->date(),
            PurchaseTable::REFERENCE_NUMBER => $this->faker->numberBetween(1000,10000),
            // PurchaseTable::SUPPLIER_ID => Supplier::factory(),
            PurchaseTable::OTHER_AMOUNT => $this->faker->numberBetween(0,500),
            PurchaseTable::DISCOUNT => $this->faker->numberBetween(0,100),
            PurchaseTable::DISCOUNT_TYPE => $this->faker->randomElement([DiscountTypeEnum::FIXED,DiscountTypeEnum::PERCENT]),
            PurchaseTable::TOTAL_AMOUNT => $this->faker->numberBetween(100,2000),
            PurchaseTable::PAID_AMOUNT => $this->faker->numberBetween(100,2000),
            PurchaseTable::ORDER_STATUS => $this->faker->randomElement([OrderStatusEnum::PENDING,OrderStatusEnum::ORDER,OrderStatusEnum::RECEIVED]),
            PurchaseTable::PAYMENT_STATUS => $this->faker->randomElement([PaymentStatusEnum::PENDING,PaymentStatusEnum::PARTIAL,PaymentStatusEnum::PAID,]),
            PurchaseTable::PURCHASE_NOTE => $this->faker->realText(),
            PurchaseTable::FINANCE_YEAR => 1,
        ];
    }
}
