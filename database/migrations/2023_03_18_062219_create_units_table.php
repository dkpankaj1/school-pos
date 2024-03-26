<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DatabaseEnum\UnitTable;
use App\Enums\DatabaseEnum\FinanceYearTable;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(UnitTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(UnitTable::NAME);
            $table->string(UnitTable::SHORTNAME);
            $table->string(UnitTable::DESCRIPTION);
            $table->unsignedBigInteger(UnitTable::FINANCE_YEAR);
            $table->foreign(UnitTable::FINANCE_YEAR)->references("id")->on(FinanceYearTable::TABLE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
