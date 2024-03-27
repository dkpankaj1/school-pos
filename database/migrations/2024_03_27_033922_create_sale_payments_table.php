<?php

use App\Enums\DatabaseEnum\SalePaymentTable;
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
        Schema::create(SalePaymentTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->timestamp(SalePaymentTable::DATE);
            $table->unsignedBigInteger(SalePaymentTable::SALE_ID);
            $table->string(SalePaymentTable::PAYMENT_METHOD);
            $table->double(SalePaymentTable::AMOUNT);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_payments');
    }
};
