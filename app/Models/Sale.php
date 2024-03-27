<?php

namespace App\Models;

use App\Enums\DatabaseEnum\SaleItemTable;
use App\Enums\DatabaseEnum\SaleTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        SaleTable::DATE,
        SaleTable::REFERENCE_NUMBER,
        SaleTable::STUDENT_ID,
        SaleTable::OTHER_AMOUNT,
        SaleTable::DISCOUNT,
        SaleTable::TOTAL_AMOUNT,
        SaleTable::PAID_AMOUNT,
        SaleTable::ORDER_STATUS,
        SaleTable::PAYMENT_STATUS,
        SaleTable::NOTE,
        SaleTable::FINANCE_YEAR,
    ];

    public function student()
    {
        return $this->belongsTo(Student::class,SaleTable::STUDENT_ID,'id');
    }
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class,SaleItemTable::SALE_ID,'id');
    }
}
