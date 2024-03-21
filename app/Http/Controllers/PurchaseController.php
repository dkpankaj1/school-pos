<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\PurchaseTable;
use App\Enums\DatabaseEnum\SupplierTable;
use App\Filters\Purchase\ByDate;
use App\Filters\Purchase\ByOrder;
use App\Filters\Purchase\ByPayment;
use App\Filters\Purchase\ByReference;
use App\Filters\Purchase\BySupplier;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use Inertia\Inertia;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $purchaseQuery = Purchase::query()->with('supplier')->where(PurchaseTable::FINANCE_YEAR, $this->getFinanceYear());

        $purchaseQuery = Pipeline::send($purchaseQuery)->through([
            ByDate::class,
            BySupplier::class,
            ByReference::class,
            ByOrder::class,
            ByPayment::class
        ])->thenReturn();

        return Inertia::render('Purchase/List', [
            'purchases' => $purchaseQuery->latest()->paginate(10)->withQueryString(),
            'suppliers' =>  Supplier::query()->where(SupplierTable::FINANCE_YEAR, $this->getFinanceYear())->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Purchase/Create');
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
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
