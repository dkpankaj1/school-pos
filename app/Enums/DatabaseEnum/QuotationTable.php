<?php
namespace App\Enums\DatabaseEnum;

use App\Enums\PaymentStatus;

enum QuotationTable
{
    const TABLE = "quotations";
    const DATE = "date";
    const CODE = "code";
    const OTHER_AMOUNT = "other_amount";
    const DISCOUNT = "discount";
    const TOTAL_AMOUNT = "total_amount";
    const FINANCE_YEAR = "finance_year_id";

}
