<?php

namespace App\Http\Controllers;

use App\Models\FinanceYears;
use App\Models\Settings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Enums\DatabaseEnum\SettingTable;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Settings::first();
        $financeYear = FinanceYears::all();
        return Inertia::render('Setting/List', ['settings' => $settings, 'financeYear' => $financeYear]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'company' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'currency_code' => ['required'],
            'currency_symbol' => ['required'],
            'default_finance_year' => ['required']
        ]);

        try {
            $setting = Settings::first();
            $setting->update([
                SettingTable::COMPANY => $request->company,
                SettingTable::PHONE => $request->phone,
                SettingTable::EMAIL => $request->email,
                SettingTable::ADDRESS => $request->address,
                SettingTable::CITY => $request->city,
                SettingTable::STATE => $request->state,
                SettingTable::COUNTRY => $request->country,
                SettingTable::CURRENCY_CODE => $request->currency_code,
                SettingTable::CURRENCY_SYMBOL => $request->currency_symbol,
                SettingTable::DEFAULT_FINANCE_YEAR => $request->default_finance_year
            ]);
            return redirect()->route('setting.index')->with('success', 'Update success');
        } catch (\Exception $e) {
            return redirect()->route('setting.index')->with('danger', $e->getMessage());

        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
