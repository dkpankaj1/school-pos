<?php

namespace App\Models;

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
}
