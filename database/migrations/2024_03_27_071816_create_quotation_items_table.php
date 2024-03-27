<?php

use App\Enums\DatabaseEnum\QuotationItemsTable;
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
        Schema::create(QuotationItemsTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(QuotationItemsTable::QUOTATION_ID);
            $table->unsignedBigInteger(QuotationItemsTable::PRODUCT_ID);
            $table->double(QuotationItemsTable::MRP);
            $table->unsignedInteger(QuotationItemsTable::QUANTITY);
            $table->unsignedBigInteger(QuotationItemsTable::FINANCE_YEAR);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};
