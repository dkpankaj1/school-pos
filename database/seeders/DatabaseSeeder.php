<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\DatabaseEnum\UnitTable;
use App\Enums\ImageEnum;
use App\Models\FinanceYears;
use App\Models\Settings;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\DatabaseEnum\SettingTable;
use App\Enums\DatabaseEnum\FinanceYearTable;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(100)->create();

        User::create([
            'name' => "admin",
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        FinanceYears::create([
            FinanceYearTable::NAME => "2024-2025",
            FinanceYearTable::FROM_DATE => "01-04-2024",
            FinanceYearTable::TO_DATE => "31-03-2025",
        ]);

        FinanceYears::create([
            FinanceYearTable::NAME => "2025-2026",
            FinanceYearTable::FROM_DATE => "01-04-2025",
            FinanceYearTable::TO_DATE => "31-03-2026",
        ]);

        Unit::create([
            UnitTable::NAME => "Pices",
            UnitTable::SHORTNAME => "PC",
            UnitTable::DESCRIPTION => "Pices",
            UnitTable::FINANCE_YEAR => '1'
        ]);

        Settings::create([
            SettingTable::COMPANY => "Cortex It Solution",
            SettingTable::PHONE => "+91 9919823355",
            SettingTable::EMAIL => "cortexitsolution.cits@gmail.com",
            SettingTable::ADDRESS => "hata",
            SettingTable::CITY => "hata",
            SettingTable::STATE => "uttar pradesh",
            SettingTable::COUNTRY => "india",
            SettingTable::LOGO => ImageEnum::DEFAULT_LOGO ,
           SettingTable::FAVICON => ImageEnum::DEFAULT_FAVICON,
           SettingTable::CURRENCY_CODE=> "INR",
           SettingTable::CURRENCY_SYMBOL => "₹",
           SettingTable::DEFAULT_FINANCE_YEAR => 1
        ]);
    }
}
