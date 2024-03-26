<?php

namespace App\Models;

use App\Enums\DatabaseEnum\SaleTable;
use App\Enums\DatabaseEnum\StudentTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        StudentTable::NAME,
        StudentTable::ENROLMENT_NO,
        StudentTable::FATHER,
        StudentTable::REMARK,
        StudentTable::CLASSES,
        StudentTable::FINANCE_YEAR,
    ];

    public function classes()
    {
        return $this->belongsTo(StudentClass::class,StudentTable::CLASSES,'id');
    }
    public function sales()
    {
        return $this->hasMany(Sale::class,SaleTable::STUDENT_ID,'id');
    }
}
