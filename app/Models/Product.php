<?php

namespace App\Models;

use App\Enums\DatabaseEnum\ProductTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        ProductTable::CODE,
        ProductTable::NAME,
        ProductTable::DESCRIPTION,
        ProductTable::MRP,
        ProductTable::COST,
        ProductTable::IMAGE,
        ProductTable::CATEGORIES,
        ProductTable::UNIT,
        ProductTable::FINANCE_YEAR,
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}