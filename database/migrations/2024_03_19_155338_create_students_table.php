<?php

use App\Enums\DatabaseEnum\FinanceYearTable;
use App\Enums\DatabaseEnum\StudentClassTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DatabaseEnum\StudentTable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(StudentTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(StudentTable::NAME);
            $table->string(StudentTable::ENROLMENT_NO)->unique();
            $table->string(StudentTable::FATHER);
            $table->string(StudentTable::REMARK);
            $table->unsignedBigInteger(StudentTable::CLASSES);
            $table->unsignedBigInteger(StudentTable::FINANCE_YEAR);
            $table->timestamps();

            $table->foreign(StudentTable::CLASSES)->references("id")->on(StudentClassTable::TABLE)->cascadeOnDelete();
            $table->foreign(StudentTable::FINANCE_YEAR)->references("id")->on(FinanceYearTable::TABLE)->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
