<?php
namespace App\Enums\DatabaseEnum;

use App\Enums\PaymentStatus;

enum PurchaseTable
{
    const TABLE = "purchases";
    const DATE = "date";
    const REFERENCE_NUMBER = "reference_number";
    const SUPPLIER_ID = "supplier_id";
    const OTHER_AMOUNT = "other_amount";
    const DISCOUNT = "discount";
    const DISCOUNT_TYPE = "discount_type";
    const TOTAL_AMOUNT = "total_amount";
    const PAID_AMOUNT = "paid_amount";
    CONST ORDER_STATUS = "order_status";
    const PAYMENT_STATUS = "payment_status";
    const PURCHASE_NOTE = "purchase_notes";
    const FINANCE_YEAR = "finance_year_id";

}
