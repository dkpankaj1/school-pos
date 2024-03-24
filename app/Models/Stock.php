<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DatabaseEnum\StockTable;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
         StockTable::PRODUCT_ID,
         StockTable::QUANTITY,
         StockTable::FINANCE_YEAR,
    ];


    public function product(){
        return $this->belongsTo(Product::class,StockTable::PRODUCT_ID,'id');
    }
    public function finance_year(){
        return $this->belongsTo(FinanceYears::class,StockTable::FINANCE_YEAR,'id');
    }
}
