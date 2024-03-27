<?php

use App\Enums\DatabaseEnum\QuotationTable;
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
        Schema::create(QuotationTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->timestamp(QuotationTable::DATE);
            $table->string(QuotationTable::CODE)->unique();
            $table->double(QuotationTable::OTHER_AMOUNT);
            $table->double(QuotationTable::DISCOUNT);
            $table->double(QuotationTable::TOTAL_AMOUNT);
            $table->unsignedBigInteger(QuotationTable::FINANCE_YEAR);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
