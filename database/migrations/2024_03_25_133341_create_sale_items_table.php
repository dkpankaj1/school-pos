<?php

use App\Enums\DatabaseEnum\FinanceYearTable;
use App\Enums\DatabaseEnum\ProductTable;
use App\Enums\DatabaseEnum\SaleItemTable;
use App\Enums\DatabaseEnum\SaleTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(SaleItemTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(SaleItemTable::SALE_ID);
            $table->unsignedBigInteger(SaleItemTable::PRODUCT_ID);
            $table->double(SaleItemTable::MRP);
            $table->unsignedInteger(SaleItemTable::QUANTITY);
            $table->unsignedBigInteger(SaleItemTable::FINANCE_YEAR);
            $table->timestamps();
            
            $table->foreign(SaleItemTable::SALE_ID)->references('id')->on(SaleTable::TABLE);
            $table->foreign(SaleItemTable::PRODUCT_ID)->references('id')->on(ProductTable::TABLE);
            $table->foreign(SaleItemTable::FINANCE_YEAR)->references('id')->on(FinanceYearTable::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
