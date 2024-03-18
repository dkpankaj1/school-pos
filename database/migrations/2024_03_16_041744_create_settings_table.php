<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DatabaseEnum\SettingTable;
use App\Enums\DatabaseEnum\FinanceYearTable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(SettingTable::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(SettingTable::COMPANY)->nullable();
            $table->string(SettingTable::PHONE)->nullable();
            $table->string(SettingTable::EMAIL)->nullable();
            $table->string(SettingTable::ADDRESS)->nullable();
            $table->string(SettingTable::CITY)->nullable();
            $table->string(SettingTable::STATE)->nullable();
            $table->string(SettingTable::COUNTRY)->nullable();
            $table->binary(SettingTable::LOGO)->nullable();
            $table->binary(SettingTable::FAVICON)->nullable();
            $table->string(SettingTable::CURRENCY_CODE)->nullable();
            $table->string(SettingTable::CURRENCY_SYMBOL)->nullable();
            $table->unsignedBigInteger(SettingTable::DEFAULT_FINANCE_YEAR)->nullable();
            $table->foreign(SettingTable::DEFAULT_FINANCE_YEAR)->references('id')->on(FinanceYearTable::TABLE)->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
