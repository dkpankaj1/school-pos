<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DatabaseEnum\FinanceYearTable;

class FinanceYears extends Model
{
    use HasFactory;
    protected $fillable = [
        FinanceYearTable::NAME,
        FinanceYearTable::FROM_DATE,
        FinanceYearTable::TO_DATE,
    ];
}
