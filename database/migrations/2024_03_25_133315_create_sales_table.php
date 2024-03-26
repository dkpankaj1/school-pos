<?php

use App\Enums\DatabaseEnum\FinanceYearTable;
use App\Enums\DatabaseEnum\SaleTable;
use App\Enums\DatabaseEnum\StudentTable;
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
        Schema::create(SaleTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(SaleTable::REFERENCE_NUMBER);
            $table->timestamp(SaleTable::DATE);
            $table->unsignedBigInteger(SaleTable::STUDENT_ID);
            $table->double(SaleTable::OTHER_AMOUNT);
            $table->double(SaleTable::DISCOUNT);
            $table->double(SaleTable::TOTAL_AMOUNT);
            $table->double(SaleTable::PAID_AMOUNT);
            $table->string(SaleTable::ORDER_STATUS);
            $table->string(SaleTable::PAYMENT_STATUS);
            $table->string(SaleTable::PURCHASE_NOTE);
            $table->unsignedBigInteger(SaleTable::FINANCE_YEAR);
            $table->timestamps();
            
            $table->foreign(SaleTable::STUDENT_ID)->references('id')->on(StudentTable::TABLE);
            $table->foreign(SaleTable::FINANCE_YEAR)->references('id')->on(FinanceYearTable::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
