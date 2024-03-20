<?php

namespace App\Models;

use App\Enums\DatabaseEnum\ProductTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DatabaseEnum\CategoriesTable;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
       CategoriesTable::NAME,
       CategoriesTable::DESCRIPTION,
       CategoriesTable::FINANCE_YEAR,
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
