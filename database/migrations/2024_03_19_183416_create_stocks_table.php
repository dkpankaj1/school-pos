<?php

use App\Enums\DatabaseEnum\FinanceYearTable;
use App\Enums\DatabaseEnum\ProductTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DatabaseEnum\StockTable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(StockTable::PRODUCT_ID);
            $table->unsignedBigInteger(StockTable::QUANTITY)->default(0);
            $table->unsignedBigInteger(StockTable::FINANCE_YEAR);
            $table->timestamps();

            $table->foreign(StockTable::PRODUCT_ID)->references('id')->on(ProductTable::TABLE);
            $table->foreign(StockTable::FINANCE_YEAR)->references('id')->on(FinanceYearTable::TABLE)->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
