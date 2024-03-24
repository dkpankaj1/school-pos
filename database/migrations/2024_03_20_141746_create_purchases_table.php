<?php

use App\Enums\DatabaseEnum\FinanceYearTable;
use App\Enums\DatabaseEnum\SupplierTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DatabaseEnum\PurchaseTable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(PurchaseTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(PurchaseTable::REFERENCE_NUMBER);
            $table->timestamp(PurchaseTable::DATE);
            $table->unsignedBigInteger(PurchaseTable::SUPPLIER_ID);
            $table->double(PurchaseTable::OTHER_AMOUNT);
            $table->double(PurchaseTable::DISCOUNT);
            $table->double(PurchaseTable::TOTAL_AMOUNT);
            $table->double(PurchaseTable::PAID_AMOUNT);
            $table->string(PurchaseTable::ORDER_STATUS);
            $table->string(PurchaseTable::PAYMENT_STATUS);
            $table->string(PurchaseTable::PURCHASE_NOTE);
            $table->unsignedBigInteger(PurchaseTable::FINANCE_YEAR);
            $table->timestamps();

            $table->foreign(PurchaseTable::SUPPLIER_ID)->references('id')->on(SupplierTable::TABLE)->cascadeOnDelete();
            $table->foreign(PurchaseTable::FINANCE_YEAR)->references('id')->on(FinanceYearTable::TABLE)->cascadeOnDelete();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
