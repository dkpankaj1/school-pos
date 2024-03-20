<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\DatabaseEnum\StudentClassTable;
use App\Enums\DatabaseEnum\UnitTable;
use App\Enums\ImageEnum;
use App\Models\Categories;
use App\Models\FinanceYears;
use App\Models\Product;
use App\Models\Settings;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
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
            FinanceYearTable::FROM_DATE =>Carbon::create(2024,4,1) ,
            FinanceYearTable::TO_DATE =>Carbon::create(2025,3,31) ,
        ]);

        FinanceYears::create([
            FinanceYearTable::NAME => "2025-2026",
            FinanceYearTable::FROM_DATE => Carbon::create(2025,4,1),
            FinanceYearTable::TO_DATE =>Carbon::create(2026,3,31),
        ]);

        Unit::create([
            UnitTable::NAME => "Pice",
            UnitTable::SHORTNAME => "PC",
            UnitTable::DESCRIPTION => "Pice",
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
            SettingTable::LOGO => ImageEnum::DEFAULT_LOGO,
            SettingTable::FAVICON => ImageEnum::DEFAULT_FAVICON,
            SettingTable::CURRENCY_CODE => "INR",
            SettingTable::CURRENCY_SYMBOL => "₹",
            SettingTable::DEFAULT_FINANCE_YEAR => 1
        ]);

        StudentClass::insert([
            [StudentClassTable::NAME => "LKG",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "UKG",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 1st",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 2nd",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 3rd",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 4th",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 5th",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 6th",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 7th",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 8th",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 9th",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 10th",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 11th",StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "CLASS 12th",StudentClassTable::FINANCE_YEAR => 1],
        ]);

        Student::factory(50)->create();

        Categories::factory(10)->create();
        Product::factory(100)->create();
    }
}
