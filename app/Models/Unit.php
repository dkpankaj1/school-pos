<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DatabaseEnum\UnitTable;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        UnitTable::NAME,
        UnitTable::SHORTNAME,
        UnitTable::DESCRIPTION,
        UnitTable::FINANCE_YEAR,
    ];
}
