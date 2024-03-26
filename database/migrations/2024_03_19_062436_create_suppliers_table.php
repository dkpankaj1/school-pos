<?php

use App\Enums\DatabaseEnum\FinanceYearTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DatabaseEnum\SupplierTable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(SupplierTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(SupplierTable::NAME);
            $table->string(SupplierTable::EMAIL)->nullable();
            $table->string(SupplierTable::PHONE);
            $table->string(SupplierTable::ADDRESS)->nullable();
            $table->string(SupplierTable::CITY)->nullable();
            $table->string(SupplierTable::STATE)->nullable();
            $table->string(SupplierTable::COUNTRY)->nullable();
            $table->string(SupplierTable::POSTAL_CODE)->nullable();
            $table->unsignedBigInteger(SupplierTable::FINANCE_YEAR);
            $table->timestamps();

            $table->foreign(SupplierTable::FINANCE_YEAR)->references("id")->on(FinanceYearTable::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
