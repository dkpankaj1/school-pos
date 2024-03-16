<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        Settings::create([
            'company' => "Cortex It Solution",
            'phone' => "+91 9919823355",
            'email' => "cit",
            'address' => "cortexitsolution.cits@gmail.com",
            'city' => "hata",
            'state' => "uttar pradesh",
            'country' => "india",
            'logo' => "none",
            'fev_icon' => "none",
            'currency_code' => "INR",
            'currency_symbol' => "₹",
        ]);
    }
}
