<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DatabaseEnum\CategoriesTable;
use App\Enums\DatabaseEnum\FinanceYearTable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(CategoriesTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(CategoriesTable::NAME);
            $table->text( CategoriesTable::DESCRIPTION);
            $table->unsignedBigInteger(CategoriesTable::FINANCE_YEAR);
            $table->foreign(CategoriesTable::FINANCE_YEAR)->references('id')->on(FinanceYearTable::TABLE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
