<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\DatabaseEnum\CategoriesTable;
use App\Enums\DatabaseEnum\ProductTable;
use App\Enums\DatabaseEnum\StockTable;
use App\Enums\DatabaseEnum\StudentClassTable;
use App\Enums\DatabaseEnum\SupplierTable;
use App\Enums\DatabaseEnum\UnitTable;
use App\Enums\ImageEnum;
use App\Models\Categories;
use App\Models\FinanceYears;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Settings;
use App\Models\Stock;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Supplier;
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

        FinanceYears::insert([
            [
                FinanceYearTable::NAME => "2024-2025",
                FinanceYearTable::FROM_DATE => Carbon::create(2024, 4, 1),
                FinanceYearTable::TO_DATE => Carbon::create(2025, 3, 31),
            ],
            [
                FinanceYearTable::NAME => "2025-2026",
                FinanceYearTable::FROM_DATE => Carbon::create(2025, 4, 1),
                FinanceYearTable::TO_DATE => Carbon::create(2026, 3, 31),
            ]
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
            [StudentClassTable::NAME => "NURSERY", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "LKG", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "UKG", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "1st", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "2nd", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "3rd", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "4th", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "5th", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "6th", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "7th", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "8th", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "9th", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "10th", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "11th", StudentClassTable::FINANCE_YEAR => 1],
            [StudentClassTable::NAME => "12th", StudentClassTable::FINANCE_YEAR => 1],
        ]);

        Categories::create([
            CategoriesTable::NAME => "Stationary",
            CategoriesTable::DESCRIPTION => "no description",
            CategoriesTable::FINANCE_YEAR => 1
        ]);

        Categories::create([
            CategoriesTable::NAME => "Dress",
            CategoriesTable::DESCRIPTION => "no description",
            CategoriesTable::FINANCE_YEAR => 1
        ]);

        Categories::create([
            CategoriesTable::NAME => "Shoes And Shocks",
            CategoriesTable::DESCRIPTION => "no description",
            CategoriesTable::FINANCE_YEAR => 1
        ]);


        $productData = array(
            array(
                'code' => 1234567896,
                'name' => 'Peek-a-boo-Hindi Magic - B2',
                'cost' => 319,
                'mrp' => 319,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567897,
                'name' => 'T-Shirt 32',
                'cost' => 0,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567898,
                'name' => 'Black Shoes No.2',
                'cost' => 0,
                'mrp' => 520,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567899,
                'name' => 'Hindi Varnmala Chitrawali',
                'cost' => 180,
                'mrp' => 180,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567900,
                'name' => 'Hindi Akshar Lekhan',
                'cost' => 200,
                'mrp' => 200,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567901,
                'name' => 'Peek-a-boo-Hindi Magic - Jadui Sargam-A',
                'cost' => 229,
                'mrp' => 229,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567902,
                'name' => 'Pre-School Print Capital Letters',
                'cost' => 180,
                'mrp' => 180,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567903,
                'name' => 'Peek -a-boo-English Magic Capital Letters - B2',
                'cost' => 349,
                'mrp' => 349,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567904,
                'name' => 'Pre-School Cursive Capital Letters',
                'cost' => 180,
                'mrp' => 180,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567905,
                'name' => 'Peek-a-boo-English Magic Rhyme Book-A',
                'cost' => 219,
                'mrp' => 219,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567906,
                'name' => 'Pre-School Phonic Picture Book(5)',
                'cost' => 150,
                'mrp' => 150,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567907,
                'name' => 'Pre-School Numbers (1-100)',
                'cost' => 180,
                'mrp' => 180,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567908,
                'name' => '2-Line Hindi Copy',
                'cost' => 55,
                'mrp' => 55,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567909,
                'name' => '4-Line English Copy',
                'cost' => 55,
                'mrp' => 55,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567910,
                'name' => 'Maths Copy',
                'cost' => 55,
                'mrp' => 55,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567911,
                'name' => 'Single Line Hindi Copy',
                'cost' => 55,
                'mrp' => 55,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567912,
                'name' => 'Drawing Copy',
                'cost' => 55,
                'mrp' => 55,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567913,
                'name' => 'Single Line Hindi Practical Copy',
                'cost' => 55,
                'mrp' => 55,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567914,
                'name' => 'Peek-a-boo-Hindi Magic - C',
                'cost' => 229,
                'mrp' => 229,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567915,
                'name' => 'Peek-a-boo-Hindi Magic - Jadui Sargam-B',
                'cost' => 229,
                'mrp' => 229,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567916,
                'name' => 'Pre-School Cursive Capital & Small Letters',
                'cost' => 180,
                'mrp' => 180,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567917,
                'name' => 'Peek-a-boo-English Magic Rhyme Book-B',
                'cost' => 219,
                'mrp' => 219,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567918,
                'name' => 'Cursive Phonic (Primer)Language Skills',
                'cost' => 190,
                'mrp' => 190,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567919,
                'name' => 'Peek-a-boo-Math Magic C',
                'cost' => 379,
                'mrp' => 379,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567920,
                'name' => 'Pre School Phonic Primer Reader',
                'cost' => 160,
                'mrp' => 160,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567921,
                'name' => 'Plastic Crayons 13 Colours',
                'cost' => 60,
                'mrp' => 60,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567922,
                'name' => 'Cover',
                'cost' => 70,
                'mrp' => 70,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567923,
                'name' => 'Pencils',
                'cost' => 50,
                'mrp' => 50,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567924,
                'name' => 'Oil Pastel (25 Colours)',
                'cost' => 85,
                'mrp' => 85,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567925,
                'name' => 'Poster Colour(12 Colours)',
                'cost' => 150,
                'mrp' => 150,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567926,
                'name' => 'Together With English Multicourse - I',
                'cost' => 469,
                'mrp' => 469,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567927,
                'name' => 'Amazing Cursive Writing - I',
                'cost' => 229,
                'mrp' => 229,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567928,
                'name' => 'Together With Sone Chiraiya - I (Hindi Text Book)',
                'cost' => 449,
                'mrp' => 449,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567929,
                'name' => 'Maths World - I',
                'cost' => 390,
                'mrp' => 390,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567930,
                'name' => 'Together With Science - I',
                'cost' => 419,
                'mrp' => 419,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567931,
                'name' => 'Together With Social Studies - I',
                'cost' => 419,
                'mrp' => 419,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567932,
                'name' => 'IT World - I',
                'cost' => 300,
                'mrp' => 300,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567933,
                'name' => 'Brain Train-I',
                'cost' => 258,
                'mrp' => 258,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567934,
                'name' => 'Creative Minds - I',
                'cost' => 365,
                'mrp' => 365,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567935,
                'name' => 'Together With English Multicourse - II',
                'cost' => 499,
                'mrp' => 499,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567936,
                'name' => 'Amazing Cursive Writing - II',
                'cost' => 229,
                'mrp' => 229,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567937,
                'name' => 'Together With Sone Chiraiya - II (Hindi Text Book)',
                'cost' => 499,
                'mrp' => 499,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567938,
                'name' => 'Maths World - II',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567939,
                'name' => 'Together With Science - II',
                'cost' => 449,
                'mrp' => 449,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567940,
                'name' => 'Together With Social Studies - II',
                'cost' => 449,
                'mrp' => 449,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567941,
                'name' => 'IT World - II',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567942,
                'name' => 'Brain Train-II',
                'cost' => 268,
                'mrp' => 268,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567943,
                'name' => 'Creative Minds - II',
                'cost' => 375,
                'mrp' => 375,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567944,
                'name' => 'Together With English Multicourse - III',
                'cost' => 519,
                'mrp' => 519,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567945,
                'name' => 'Amazing Cursive Writing - III',
                'cost' => 229,
                'mrp' => 229,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567946,
                'name' => 'Together With Sone Chiraiya - III (Hindi Text Book)',
                'cost' => 449,
                'mrp' => 449,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567947,
                'name' => 'Maths World - III',
                'cost' => 450,
                'mrp' => 450,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567948,
                'name' => 'Together With Science - III',
                'cost' => 469,
                'mrp' => 469,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567949,
                'name' => 'Together With Social Studies - III',
                'cost' => 469,
                'mrp' => 469,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567950,
                'name' => 'IT World - III',
                'cost' => 320,
                'mrp' => 320,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567951,
                'name' => 'Brain Train-III',
                'cost' => 278,
                'mrp' => 278,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567952,
                'name' => 'Creative Minds - III',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567953,
                'name' => 'Together With English Multicourse - IV',
                'cost' => 549,
                'mrp' => 549,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567954,
                'name' => 'Amazing Cursive Writing - IV',
                'cost' => 229,
                'mrp' => 229,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567955,
                'name' => 'Together With Sone Chiraiya - IV (Hindi Text Book)',
                'cost' => 469,
                'mrp' => 469,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567956,
                'name' => 'Maths World - IV',
                'cost' => 470,
                'mrp' => 470,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567957,
                'name' => 'Together With Science - IV',
                'cost' => 479,
                'mrp' => 479,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567958,
                'name' => 'Together With Social Studies - IV',
                'cost' => 479,
                'mrp' => 479,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567959,
                'name' => 'IT World - IV',
                'cost' => 340,
                'mrp' => 340,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567960,
                'name' => 'Brain Train-IV',
                'cost' => 288,
                'mrp' => 288,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567961,
                'name' => 'Creative Minds - IV',
                'cost' => 425,
                'mrp' => 425,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567962,
                'name' => 'Together With English Multicourse - V',
                'cost' => 549,
                'mrp' => 549,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567963,
                'name' => 'Amazing Cursive Writing - V',
                'cost' => 229,
                'mrp' => 229,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567964,
                'name' => 'Together With Sone Chiraiya - V (Hindi Text Book)',
                'cost' => 469,
                'mrp' => 469,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567965,
                'name' => 'Maths World - V',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567966,
                'name' => 'Together With Science - V',
                'cost' => 499,
                'mrp' => 499,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567967,
                'name' => 'Together With Social Studies - V',
                'cost' => 499,
                'mrp' => 499,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567968,
                'name' => 'IT World - V',
                'cost' => 360,
                'mrp' => 360,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567969,
                'name' => 'Brain Train-V',
                'cost' => 298,
                'mrp' => 298,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567970,
                'name' => 'Creative Minds - V',
                'cost' => 425,
                'mrp' => 425,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567971,
                'name' => 'Together With English Multicourse - VI',
                'cost' => 559,
                'mrp' => 559,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567972,
                'name' => 'Together With Sone Chiraiya - VI (Hindi Text Book)',
                'cost' => 449,
                'mrp' => 449,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567973,
                'name' => 'Connect With Mathematics - VI',
                'cost' => 530,
                'mrp' => 530,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567974,
                'name' => 'Together With Science - VI',
                'cost' => 569,
                'mrp' => 569,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567975,
                'name' => 'Together With Social Studies - VI',
                'cost' => 569,
                'mrp' => 569,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567976,
                'name' => 'Sanskrit - VI',
                'cost' => 65,
                'mrp' => 65,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567977,
                'name' => 'IT World - VI',
                'cost' => 380,
                'mrp' => 380,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567978,
                'name' => 'Brain Train-VI',
                'cost' => 300,
                'mrp' => 300,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567979,
                'name' => 'Creative Minds - VI',
                'cost' => 425,
                'mrp' => 425,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567980,
                'name' => 'Wonder Map Practice Book-VI',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567981,
                'name' => 'Together With English Multicourse - VII',
                'cost' => 569,
                'mrp' => 569,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567982,
                'name' => 'Together With Sone Chiraiya - VII (Hindi Text Book)',
                'cost' => 449,
                'mrp' => 449,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567983,
                'name' => 'Connect With Mathematics - VII',
                'cost' => 530,
                'mrp' => 530,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567984,
                'name' => 'Together With Science - VII',
                'cost' => 579,
                'mrp' => 579,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567985,
                'name' => 'Together With Social Studies - VII',
                'cost' => 579,
                'mrp' => 579,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567986,
                'name' => 'Sanskrit - VII',
                'cost' => 50,
                'mrp' => 50,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567987,
                'name' => 'IT World - VII',
                'cost' => 400,
                'mrp' => 400,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567988,
                'name' => 'Brain Train-VII',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567989,
                'name' => 'Creative Minds - VII',
                'cost' => 425,
                'mrp' => 425,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567990,
                'name' => 'Wonder Map Practice Book - VII',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567991,
                'name' => 'Together With English Multicourse - VIII',
                'cost' => 579,
                'mrp' => 579,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567992,
                'name' => 'Together With Sone Chiraiya - VIII (Hindi Text Book)',
                'cost' => 499,
                'mrp' => 499,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567993,
                'name' => 'Connect With Mathematics - VIII',
                'cost' => 530,
                'mrp' => 530,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567994,
                'name' => 'Together With Science - VIII',
                'cost' => 589,
                'mrp' => 589,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567995,
                'name' => 'Together With Social Studies - VIII',
                'cost' => 589,
                'mrp' => 589,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567996,
                'name' => 'Sanskrit - VIII',
                'cost' => 65,
                'mrp' => 65,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567997,
                'name' => 'IT World - VIII',
                'cost' => 430,
                'mrp' => 430,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567998,
                'name' => 'Brain Train-VIII',
                'cost' => 320,
                'mrp' => 320,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234567999,
                'name' => 'Creative Minds-VIII',
                'cost' => 425,
                'mrp' => 425,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568000,
                'name' => 'Wonder Map Practice Book - VIII',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)-22',
                'name' => 'Skirt Regular',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)-24',
                'name' => 'Skirt Regular',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)-26',
                'name' => 'Skirt Regular',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)-28',
                'name' => 'Skirt Regular',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)-30',
                'name' => 'Skirt Regular',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)-32',
                'name' => 'Skirt Regular',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)-34',
                'name' => 'Skirt Regular',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)-36',
                'name' => 'Skirt Regular',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)-38',
                'name' => 'Skirt Regular',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)-40',
                'name' => 'Skirt Regular',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(W)-22',
                'name' => 'Skirt White',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(W)-24',
                'name' => 'Skirt White',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(W)-26',
                'name' => 'Skirt White',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(W)-28',
                'name' => 'White skirt',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(W)-30',
                'name' => 'Skirt White',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(W)-32',
                'name' => 'Skirt White',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(W)-34',
                'name' => 'Skirt White',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(W)-36',
                'name' => 'Skirt White',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(W)-38',
                'name' => 'Skirt White',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(W)-40',
                'name' => 'Skirt White',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)PE 22',
                'name' => 'Skirt Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)PE-24',
                'name' => 'Skirt Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)PE-26',
                'name' => 'Skirt Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)PE-28',
                'name' => 'Skirt Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)PE-30',
                'name' => 'Skirt Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)PE-32',
                'name' => 'Skirt Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)PE-34',
                'name' => 'Skirt Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)PE-36',
                'name' => 'Skirt Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)PE-38',
                'name' => 'Skirt Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-22',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-24',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-26',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-22',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-24',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-26',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-28',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-28',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-30',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-32',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-34',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-36',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-38',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-40',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-30',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-42',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-44',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(R)-46',
                'name' => 'House T-Shirt Red',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-32',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-22',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-24',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-26',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-28',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-30',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-32',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)PE-22',
                'name' => 'Full Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-34',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-36',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)PE-24',
                'name' => 'Full Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-38',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-40',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-42',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)PE-26',
                'name' => 'Full Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(B)-44',
                'name' => 'House T-Shirt Blue',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)PE-28',
                'name' => 'Full Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-22',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)P-22',
                'name' => 'Half Shirt White  Playway',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-24',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-26',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-28',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)P-24',
                'name' => 'Half Shirt White  Playway',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-30',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-32',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-34',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)P-26',
                'name' => 'Half Shirt White  Playway',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-36',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-38',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-40',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-42',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(G)-44',
                'name' => 'House T-Shirt Green',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)P-28',
                'name' => 'Half Shirt White  Playway',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-22',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)P-30',
                'name' => 'Half Shirt White  Playway',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-24',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-26',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-28',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-30',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-32',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-34',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-36',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-38',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-40',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-42',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HTS(Y)-44',
                'name' => 'House T-Shirt Yellow',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)P-22',
                'name' => 'Full Shirt White  Playway',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)P-24',
                'name' => 'Full Shirt White  Playway',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-22',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)P-26',
                'name' => 'Full Shirt White  Playway',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-24',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)P-28',
                'name' => 'Full Shirt White  Playway',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-26',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-28',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-30',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-32',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-34',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-36',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-38',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-40',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-42',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)-44',
                'name' => 'Full Shirt White',
                'cost' => 385,
                'mrp' => 385,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)E-22',
                'name' => 'Full Pant Regular Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)E-24',
                'name' => 'Full Pant Regular Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)E-26',
                'name' => 'Full Pant Regular Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)E-28',
                'name' => 'Full Pant Regular Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)E-30',
                'name' => 'Full Pant Regular Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)E-32',
                'name' => 'Full Pant Regular Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)E-34',
                'name' => 'Full Pant Regular Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)E-36',
                'name' => 'Full Pant Regular Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)E-38',
                'name' => 'Full Pant Regular Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)E-22',
                'name' => 'Full Pant White Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)E-24',
                'name' => 'Full Pant White Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)E-26',
                'name' => 'Full Pant White Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)E-28',
                'name' => 'Full Pant White Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)E-30',
                'name' => 'Full Pant White Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)E-32',
                'name' => 'Full Pant White Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)E-34',
                'name' => 'Full Pant White Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)E-36',
                'name' => 'Full Pant White Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)E-38',
                'name' => 'Full Pant White Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)B-22',
                'name' => 'Full Pant Regular Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)B-24',
                'name' => 'Full Pant Regular Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)B-26',
                'name' => 'Full Pant Regular Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)B-28',
                'name' => 'Full Pant Regular Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)B-30',
                'name' => 'Full Pant Regular Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)B-32',
                'name' => 'Full Pant Regular Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)B-34',
                'name' => 'Full Pant Regular Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)B-36',
                'name' => 'Full Pant Regular Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)B-38',
                'name' => 'Full Pant Regular Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)B-22',
                'name' => 'Full Pant White Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)B-24',
                'name' => 'Full Pant White Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)B-26',
                'name' => 'Full Pant White Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)B-28',
                'name' => 'Full Pant White Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)B-30',
                'name' => 'Full Pant White Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)B-32',
                'name' => 'Full Pant White Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)B-34',
                'name' => 'Full Pant White Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)B-36',
                'name' => 'Full Pant White Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)B-38',
                'name' => 'Full Pant White Belt',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-22',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-24',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-26',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-28',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-30',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-32',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-34',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-36',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-38',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-40',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-42',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-44',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-22',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-24',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-26',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-28',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-30',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-32',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-34',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-36',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-38',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-40',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-42',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(W)-44',
                'name' => 'Half Shirt White',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-22',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-24',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-26',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-28',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-30',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-32',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-34',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-36',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-38',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-40',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-42',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(R)-44',
                'name' => 'Full Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568001,
                'name' => 'Beehive Textbook in English-IX',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568002,
                'name' => 'Mathematics Textbook-IX',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568003,
                'name' => 'Democratic Politics-I  (Political Science)-IX',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568004,
                'name' => 'Contemporary India-I (Social Science)-IX',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568005,
                'name' => 'India and contemporay world I',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568006,
                'name' => 'Science Textbook-IX',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568007,
                'name' => 'Kritika Part-I',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568008,
                'name' => 'Kshitig Part-I',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568009,
                'name' => 'Moments (Supplementary Reader in English)',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568010,
                'name' => 'Maths lab manual',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568011,
                'name' => 'Science lab manual',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568012,
                'name' => 'Information Technology',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568013,
                'name' => 'First Flight Textbook in English-X',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568014,
                'name' => 'Mathematics Textbook-X',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568015,
                'name' => 'Democratic Politics-II  (Political Science)-X',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568016,
                'name' => 'Contemporary India-II (Social Science)-X',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568017,
                'name' => 'India and the Contemporary World-II (Social Science',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568018,
                'name' => 'Economics Social Science Textbook-X',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568019,
                'name' => 'Science Textbook-X',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568020,
                'name' => 'Kritika Part-II',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568021,
                'name' => 'Kshitig Part-II',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568022,
                'name' => 'Foot prints without feet - X',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568023,
                'name' => 'Maths lab manual',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568024,
                'name' => 'Science lab manual',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568025,
                'name' => 'Information Technology',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568026,
                'name' => 'Cursive Strokes',
                'cost' => 180,
                'mrp' => 180,
                'category_id' => 1,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-20',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-22',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-24',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-26',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-28',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-30',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-32',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-34',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-36',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-38',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-40',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-42',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-44',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TPL-46',
                'name' => 'Track Pant Lower',
                'cost' => 310,
                'mrp' => 310,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(R)-20',
                'name' => 'Skirt Regular',
                'cost' => 440,
                'mrp' => 440,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-SKT(W)-20',
                'name' => 'Skirt White',
                'cost' => 480,
                'mrp' => 480,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)E-26/38',
                'name' => 'Full Pant White Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(W)E-28/38',
                'name' => 'Full Pant White Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HS(R)-20',
                'name' => 'Half Shirt Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-11',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-12',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-13',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-14',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-15',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-16',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-17',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-18',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-19',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HP(R)PE-20',
                'name' => 'Half Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FP(R)PE-30',
                'name' => 'Full Pant Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TU(R)PE-20',
                'name' => 'Tunic Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TU(R)PE-22',
                'name' => 'Tunic Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TU(R)PE-24',
                'name' => 'Tunic Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TU(R)PE-26',
                'name' => 'Tunic Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TU(R)PE-28',
                'name' => 'Tunic Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TU(R)PE-30',
                'name' => 'Tunic Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-TU(R)PE-32',
                'name' => 'Tunic Regular Playway Elastic',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)P-20',
                'name' => 'Full Shirt White Playway',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-FS(W)P-30',
                'name' => 'Full Shirt White Playway',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-20',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-22',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-24',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-26',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-28',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-30',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-32',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-34',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-36',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-38',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-40',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-42',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-44',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-HST(R)-46',
                'name' => 'Half Sweater',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-20',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-22',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-24',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-26',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-28',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-30',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-32',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-34',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-36',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-38',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-40',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-42',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-44',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 'ZPS-B(R)-46',
                'name' => 'Blazer Regular',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568027,
                'name' => 'Black Shoes Small No. 8',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568028,
                'name' => 'Black Shoes Small No. 9',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568029,
                'name' => 'Black Shoes Small No. 10',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568030,
                'name' => 'Black Shoes Small No. 11',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568031,
                'name' => 'Black Shoes Small No. 12',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568032,
                'name' => 'Black Shoes Small No. 13',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568033,
                'name' => 'Black Shoes Big No. 01',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568034,
                'name' => 'Black Shoes Big No. 02',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568035,
                'name' => 'Black Shoes Big No. 03',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568036,
                'name' => 'Black Shoes Big No. 04',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568037,
                'name' => 'Black Shoes Big No. 05',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568038,
                'name' => 'Black Shoes Big No. 06',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568039,
                'name' => 'Black Shoes Big No. 07',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568040,
                'name' => 'Black Shoes Big No. 08',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568041,
                'name' => 'Black Shoes Big No. 09',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568042,
                'name' => 'White Shoes Small No. 11',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568043,
                'name' => 'White Shoes Small No. 12',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568044,
                'name' => 'White Shoes Big No. 01',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568045,
                'name' => 'White Shoes Big No. 02',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568046,
                'name' => 'White Shoes Big No. 03',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568047,
                'name' => 'White Shoes Big No. 04',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568048,
                'name' => 'White Shoes Big No. 05',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568049,
                'name' => 'White Shoes Big No. 06',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568050,
                'name' => 'White Shoes Big No. 07',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568051,
                'name' => 'White Shoes Big No. 08',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568052,
                'name' => 'White Shoes Big No. 09',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568053,
                'name' => 'White Shoes Big No. 10',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 3,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568054,
                'name' => 'Small Tie',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568055,
                'name' => 'Big Tie',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            ),
            array(
                'code' => 1234568056,
                'name' => 'Belt 34',
                'cost' => 0,
                'mrp' => 0,
                'category_id' => 2,
                'unit_id' => 1
            )
        );
        $processedProduct = [];
        foreach ($productData as $item) {
            $processedProduct[] = [
                ProductTable::CODE => $item['code'],
                ProductTable::NAME => $item['name'],
                ProductTable::DESCRIPTION => "no description",
                ProductTable::MRP => $item['mrp'],
                ProductTable::COST => $item['cost'],
                ProductTable::IMAGE => ImageEnum::NO_PRODUCT_IMAGE,
                ProductTable::CATEGORIES => $item['category_id'],
                ProductTable::UNIT => $item['unit_id'],
                ProductTable::FINANCE_YEAR => 1,
                'created_at' => Carbon::now(),
            ];
        }

        Product::insert($processedProduct);
        
        $product_ids = Product::get()->pluck('id')->toArray();
        
        $stockData = [];

        foreach($product_ids as $ids){
           $stockData[] = [
            StockTable::PRODUCT_ID => $ids,
            StockTable::QUANTITY => 0,
            StockTable::FINANCE_YEAR => 1,
            'created_at' => Carbon::now(),
           ];
        }
        Stock::insert($stockData);


        Supplier::insert([
            [
                SupplierTable::NAME => "ZPS-OLD",
                SupplierTable::PHONE => "9794xxxx99",
                SupplierTable::EMAIL => "zpssupplier1@email.com",
                SupplierTable::ADDRESS => "Gorakhpur",
                SupplierTable::CITY => 'Gorakhpur',
                SupplierTable::STATE => "U.P.",
                SupplierTable::COUNTRY => "india",
                SupplierTable::POSTAL_CODE => "274149",
                SupplierTable::FINANCE_YEAR => 1,
            ],
            [
                SupplierTable::NAME => "ZPS",
                SupplierTable::PHONE => "9794xxxx99",
                SupplierTable::EMAIL => "zpssupplier2@email.com",
                SupplierTable::ADDRESS => "Gorakhpur",
                SupplierTable::CITY => 'Gorakhpur',
                SupplierTable::STATE => "U.P.",
                SupplierTable::COUNTRY => "india",
                SupplierTable::POSTAL_CODE => "274149",
                SupplierTable::FINANCE_YEAR => 1,
            ]
        ]);
    }
}
