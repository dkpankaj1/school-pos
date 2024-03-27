<?php

namespace App\Models;

use App\Enums\DatabaseEnum\SalePaymentTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    use HasFactory;
    protected $fillable = [
        SalePaymentTable::DATE,
        SalePaymentTable::SALE_ID,
        SalePaymentTable::AMOUNT,
        SalePaymentTable::PAYMENT_METHOD,
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class,SalePaymentTable::SALE_ID,'id');
    }
}
