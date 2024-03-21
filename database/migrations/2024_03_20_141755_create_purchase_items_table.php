<?php

use App\Enums\DatabaseEnum\FinanceYearTable;
use App\Enums\DatabaseEnum\ProductTable;
use App\Enums\DatabaseEnum\PurchaseTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DatabaseEnum\PurchaseItemTable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(PurchaseItemTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(PurchaseItemTable::PURCHASE_ID);
            $table->unsignedBigInteger(PurchaseItemTable::PRODUCT_ID);
            $table->double(PurchaseItemTable::MRP);
            $table->double(PurchaseItemTable::COST);
            $table->unsignedBigInteger(PurchaseItemTable::QUANTITY);
            $table->unsignedBigInteger(PurchaseItemTable::FINANCE_YEAR);
            $table->timestamps();

            $table->foreign(PurchaseItemTable::PURCHASE_ID)->references('id')->on(PurchaseTable::TABLE)->cascadeOnDelete();
            $table->foreign(PurchaseItemTable::PRODUCT_ID)->references('id')->on(ProductTable::TABLE)->cascadeOnDelete();
            $table->foreign(PurchaseItemTable::FINANCE_YEAR)->references('id')->on(FinanceYearTable::TABLE)->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
