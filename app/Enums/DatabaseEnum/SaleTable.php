<?php
namespace App\Enums\DatabaseEnum;

use App\Enums\PaymentStatus;

enum SaleTable
{
    const TABLE = "sales";
    const DATE = "date";
    const REFERENCE_NUMBER = "reference_number";
    const STUDENT_ID = "student_id";
    const OTHER_AMOUNT = "other_amount";
    const DISCOUNT = "discount";
    const TOTAL_AMOUNT = "total_amount";
    const PAID_AMOUNT = "paid_amount";
    CONST ORDER_STATUS = "order_status";
    const PAYMENT_STATUS = "payment_status";
    const NOTE = "notes";
    const FINANCE_YEAR = "finance_year_id";

}
