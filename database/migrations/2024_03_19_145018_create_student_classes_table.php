<?php

use App\Enums\DatabaseEnum\FinanceYearTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DatabaseEnum\StudentClassTable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(StudentClassTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(StudentClassTable::NAME)->unique();
            $table->text(StudentClassTable::DESCRIPTION)->nullable();
            $table->unsignedBigInteger(StudentClassTable::FINANCE_YEAR);
            $table->timestamps();

            $table->foreign(StudentClassTable::FINANCE_YEAR)->references("id")->on(FinanceYearTable::TABLE)->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_classes');
    }
};
