<?php
namespace App\Enums\DatabaseEnum;

use App\Enums\PaymentStatus;

enum QuotationItemsTable
{
    const TABLE = "quotation_items";
    const QUOTATION_ID = "quotation_id";
    const PRODUCT_ID = "product_id";
    const MRP = "mrp";
    const QUANTITY = "quantity";
    const FINANCE_YEAR = "finance_year_id";

}
