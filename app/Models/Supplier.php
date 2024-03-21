<?php

namespace App\Models;

use App\Enums\DatabaseEnum\PurchaseTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DatabaseEnum\SupplierTable;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        SupplierTable::NAME,
        SupplierTable::PHONE,
        SupplierTable::EMAIL,
        SupplierTable::ADDRESS,
        SupplierTable::CITY,
        SupplierTable::STATE,
        SupplierTable::COUNTRY,
        SupplierTable::POSTAL_CODE,
        SupplierTable::FINANCE_YEAR,
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class,PurchaseTable::SUPPLIER_ID,'id');
    }
}
