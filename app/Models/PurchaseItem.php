<?php

namespace App\Models;

use App\Enums\DatabaseEnum\PurchaseItemTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;
    protected $fillable = [
        PurchaseItemTable::PURCHASE_ID,
        PurchaseItemTable::PRODUCT_ID,
        PurchaseItemTable::MRP,
        PurchaseItemTable::COST,
        PurchaseItemTable::QUANTITY,
        PurchaseItemTable::STATUS,
        PurchaseItemTable::FINANCE_YEAR,
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,PurchaseItemTable::PRODUCT_ID,'id');
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class,PurchaseItemTable::PURCHASE_ID,'id');
    }
}
