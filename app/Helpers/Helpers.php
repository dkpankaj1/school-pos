<?php
namespace App\Helpers;

use App\Enums\PaymentStatusEnum;



class Helpers
{
    public static function getPaymentStatus($grand_total, $paid_amount)
    {
        if ($paid_amount == 0) {
            return PaymentStatusEnum::PENDING;
        } elseif ($paid_amount < $grand_total) {
            return PaymentStatusEnum::PARTIAL;
        } elseif ($paid_amount >= $grand_total) {
            return PaymentStatusEnum::PAID;
        }
    }
}


