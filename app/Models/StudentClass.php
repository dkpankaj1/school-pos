<?php

namespace App\Models;

use App\Enums\DatabaseEnum\StudentTable;
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

    public function students()
    {
        return $this->hasMany(Student::class,StudentTable::CLASSES,'id');
    }
}
