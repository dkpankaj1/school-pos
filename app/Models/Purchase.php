<?php

namespace App\Models;

use App\Enums\DatabaseEnum\PurchaseItemTable;
use App\Enums\DatabaseEnum\PurchaseTable;
use App\Enums\DiscountTypeEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        PurchaseTable::DATE,
        PurchaseTable::REFERENCE_NUMBER,
        PurchaseTable::SUPPLIER_ID,
        PurchaseTable::OTHER_AMOUNT,
        PurchaseTable::DISCOUNT,
        PurchaseTable::TOTAL_AMOUNT,
        PurchaseTable::PAID_AMOUNT,
        PurchaseTable::ORDER_STATUS,
        PurchaseTable::PAYMENT_STATUS,
        PurchaseTable::PURCHASE_NOTE,
        PurchaseTable::FINANCE_YEAR,
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, PurchaseTable::SUPPLIER_ID, 'id');
    }
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class, PurchaseItemTable::PURCHASE_ID, 'id');
    }
}
