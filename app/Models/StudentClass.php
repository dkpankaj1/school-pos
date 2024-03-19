<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DatabaseEnum\StudentClassTable;
class StudentClass extends Model
{
    use HasFactory;
    protected $fillable = [
        StudentClassTable::NAME,
        StudentClassTable::DESCRIPTION,
        StudentClassTable::FINANCE_YEAR,
    ];
}
