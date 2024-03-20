<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\SupplierTable;
use App\Filters\ByEmail;
use App\Filters\ByName;
use App\Filters\ByOrEmail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use Inertia\Inertia;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $supplierQuery = Supplier::query()->where(SupplierTable::FINANCE_YEAR, $this->getFinanceYear());

        $suppliers = Pipeline::send($supplierQuery)
        ->through([
            ByOrEmail::class,
            ByName::class,
        ])
        ->thenReturn()->latest()->paginate(10)->withQueryString();

        return Inertia::render('Supplier/List', ['supplier' =>$suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Supplier/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"      => "required|string",
            "email"     => "nullable|string",
            "phone"     => "required|string",
            "address"   => "nullable|string",
            "city"      => "nullable|string",
            "state"     => "nullable|string",
            "country"   => "nullable|string",
            "postal"    => "nullable|string",
        ]);

        try {

            Supplier::create([
                SupplierTable::NAME => $request->name,
                SupplierTable::PHONE => $request->phone,
                SupplierTable::EMAIL => $request->email ?? " ",
                SupplierTable::ADDRESS => $request->address ?? " ",
                SupplierTable::CITY => $request->city ?? " ",
                SupplierTable::STATE => $request->state ?? " ",
                SupplierTable::COUNTRY => $request->country ?? " ",
                SupplierTable::POSTAL_CODE => $request->postal ?? " ",
                SupplierTable::FINANCE_YEAR => $this->getFinanceYear(),
            ]);

            return redirect()->route('suppliers.index')->with('success', 'Create success');
        } catch (\Exception $e) {
            return redirect()->route('suppliers.index')->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return Inertia::render('Supplier/Edit', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            "name"      => ["required", "string"],
            "email"     => ["sometimes", "string"],
            "phone"     => ["required", "string"],
            "address"   => ["sometimes", "string"],
            "city"      => ["sometimes", "string"],
            "state"     => ["sometimes", "string"],
            "country"   => ["sometimes", "string"],
            "postal"    => ["sometimes", "string"],
        ]);

        try {

            $supplier->update([
                SupplierTable::NAME => $request->name ?? $supplier->name,
                SupplierTable::PHONE => $request->phone ?? $supplier->phone,
                SupplierTable::EMAIL => $request->email ?? $supplier->email,
                SupplierTable::ADDRESS => $request->address ?? $supplier->address,
                SupplierTable::CITY => $request->city ?? $supplier->city,
                SupplierTable::STATE => $request->state ?? $supplier->state,
                SupplierTable::COUNTRY => $request->country ?? $supplier->country,
                SupplierTable::POSTAL_CODE => $request->postal ?? $supplier->postal_code,
            ]);

            return redirect()->route('suppliers.index')->with('success', 'Update success');
        } catch (\Exception $e) {
            return redirect()->route('suppliers.index')->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            return redirect()->route('suppliers.index')->with('success', 'Delete success');
        } catch (\Exception $e) {
            return redirect()->route('suppliers.index')->with('danger', $e->getMessage());
        }
    }
}
