<?php

namespace App\Models;

use App\Enums\DatabaseEnum\SaleItemTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $fillable = [
        SaleItemTable::SALE_ID,
        SaleItemTable::PRODUCT_ID,
        SaleItemTable::MRP,
        SaleItemTable::QUANTITY,
        SaleItemTable::FINANCE_YEAR,
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,SaleItemTable::PRODUCT_ID,'id');
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class,SaleItemTable::SALE_ID,'id');
    }
}
