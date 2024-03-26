<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DatabaseEnum\ProductTable;
use App\Enums\DatabaseEnum\CategoriesTable;
use App\Enums\DatabaseEnum\UnitTable;
use App\Enums\DatabaseEnum\FinanceYearTable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(ProductTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(ProductTable::CODE)->unique();
            $table->string(ProductTable::NAME);
            $table->text(ProductTable::DESCRIPTION);
            $table->double(ProductTable::MRP,8,2)->default(0);
            $table->double(ProductTable::COST,8,2)->default(0);
            $table->binary(ProductTable::IMAGE)->nullable();
            $table->unsignedBigInteger(ProductTable::CATEGORIES);
            $table->unsignedBigInteger(ProductTable::UNIT);
            $table->unsignedBigInteger(ProductTable::FINANCE_YEAR);

            $table->foreign(ProductTable::CATEGORIES)->references("id")->on(CategoriesTable::TABLE);
            $table->foreign(ProductTable::UNIT)->references("id")->on(UnitTable::TABLE);
            $table->foreign(ProductTable::FINANCE_YEAR)->references('id')->on(FinanceYearTable::TABLE);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
