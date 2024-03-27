<?php
namespace App\Enums\DatabaseEnum;

use App\Enums\PaymentStatus;

enum SalePaymentTable
{
    const TABLE = "sale_payments";
    const DATE = "date";
    const SALE_ID = "sale_id";
    const AMOUNT = "amount";
    const PAYMENT_METHOD = "payment_method";

}
