<?php

namespace App\Models;

use App\Enums\DatabaseEnum\QuotationItemsTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItems extends Model
{
    use HasFactory;
    protected $fillable = [
        QuotationItemsTable::QUOTATION_ID,
        QuotationItemsTable::PRODUCT_ID,
        QuotationItemsTable::MRP,
        QuotationItemsTable::QUANTITY,
        QuotationItemsTable::FINANCE_YEAR,
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, QuotationItemsTable::QUOTATION_ID, 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, QuotationItemsTable::PRODUCT_ID, 'id');
    }
}
