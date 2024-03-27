<?php

namespace App\Models;

use App\Enums\DatabaseEnum\QuotationItemsTable;
use App\Enums\DatabaseEnum\QuotationTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $fillable = [
        QuotationTable::DATE,
        QuotationTable::CODE,
        QuotationTable::OTHER_AMOUNT,
        QuotationTable::DISCOUNT,
        QuotationTable::TOTAL_AMOUNT,
        QuotationTable::FINANCE_YEAR,
    ];
    public function items()
    {
        return $this->hasMany(QuotationItems::class,QuotationItemsTable::QUOTATION_ID,'id');
    }
}
