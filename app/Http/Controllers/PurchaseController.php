<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\ProductTable;
use App\Enums\DatabaseEnum\PurchaseItemTable;
use App\Enums\DatabaseEnum\PurchaseTable;
use App\Enums\DatabaseEnum\SupplierTable;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Filters\Purchase\ByDate;
use App\Filters\Purchase\ByOrder;
use App\Filters\Purchase\ByPayment;
use App\Filters\Purchase\ByReference;
use App\Filters\Purchase\BySupplier;
use App\Helpers\Helpers;
use App\Http\Resources\PurchaseResource;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Validation\Rule;
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
            'purchases' => PurchaseResource::collection($purchaseQuery->latest()->paginate(10)->withQueryString()),
            'suppliers' => Supplier::where(SupplierTable::FINANCE_YEAR, $this->getFinanceYear())->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $products = Product::query()
            ->where(ProductTable::FINANCE_YEAR, $this->getFinanceYear())
            ->select(['id', 'name', 'code', 'mrp', 'cost'])
            ->get();

        return Inertia::render('Purchase/Create', [
            'suppliers' => fn() => Supplier::where(SupplierTable::FINANCE_YEAR, $this->getFinanceYear())->get(),
            'products' => fn() => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier' => ['required', Rule::exists(Supplier::class, 'id')],
            'purchase_date' => ['required', 'date'],
            'reference' => ['required', 'string'],
            'status' => ['required', 'string'],
            'other_charges' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'grand_total' => ['required', 'numeric', 'min:0'],
            'cart_items' => ['required', 'array'],
            'cart_items.*.id' => ['required', 'integer', Rule::exists(Product::class, 'id')],
            'cart_items.*.quantity' => ['required', 'integer', 'min:1'],
            'cart_items.*.mrp' => ['required', 'numeric', 'min:0'],
            'cart_items.*.cost' => ['required', 'numeric', 'min:0'],
        ]);

        try {
            DB::transaction(function () use ($request) {

                $grand_total = doubleval($request->grand_total);

                $purchase = Purchase::create([
                    PurchaseTable::DATE => $request->purchase_date,
                    PurchaseTable::REFERENCE_NUMBER => $request->reference,
                    PurchaseTable::SUPPLIER_ID => $request->supplier,
                    PurchaseTable::OTHER_AMOUNT => doubleval($request->other_charges),
                    PurchaseTable::DISCOUNT => doubleval($request->discount),
                    PurchaseTable::TOTAL_AMOUNT => $grand_total,
                    PurchaseTable::PAID_AMOUNT => 0,
                    PurchaseTable::ORDER_STATUS => $request->status,
                    PurchaseTable::PAYMENT_STATUS => PaymentStatusEnum::PENDING,
                    PurchaseTable::PURCHASE_NOTE => $request->note ?? "no notes.",
                    PurchaseTable::FINANCE_YEAR => $this->getFinanceYear()
                ]);

                $cartItem = [];

                foreach ($request->cart_items as $item) {
                    $data[PurchaseItemTable::PURCHASE_ID] = $purchase->id;
                    $data[PurchaseItemTable::PRODUCT_ID] = intval($item['id']);
                    $data[PurchaseItemTable::QUANTITY] = intval($item['quantity']);
                    $data[PurchaseItemTable::MRP] = doubleval($item['mrp']);
                    $data[PurchaseItemTable::COST] = doubleval($item['cost']);
                    $data[PurchaseItemTable::STATUS] = $purchase->order_status === OrderStatusEnum::RECEIVED ? 1 : 0;
                    $data[PurchaseItemTable::FINANCE_YEAR] = $this->getFinanceYear();
                    $data['created_at'] = Carbon::now();
                    $cartItem[] = $data;
                }
                PurchaseItem::insert($cartItem);
            });

            return redirect()->route('purchases.index')->with('success', 'Create Success');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
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
        $products = Product::query()
            ->where(ProductTable::FINANCE_YEAR, $this->getFinanceYear())
            ->select(['id', 'name', 'code', 'mrp', 'cost'])
            ->get();

        return Inertia::render('Purchase/Edit', [
            'suppliers' => fn() => Supplier::where(SupplierTable::FINANCE_YEAR, $this->getFinanceYear())->get(),
            'products' => fn() => $products,
            'purchase' => new PurchaseResource($purchase),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'supplier' => ['required', Rule::exists(Supplier::class, 'id')],
            'purchase_date' => ['required', 'date'],
            'reference' => ['required', 'string'],
            'status' => ['required', 'string'],
            'other_charges' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'grand_total' => ['required', 'numeric', 'min:0'],
            'cart_items' => ['required', 'array'],
            'cart_items.*.id' => ['required', 'integer', Rule::exists(Product::class, 'id')],
            'cart_items.*.quantity' => ['required', 'integer', 'min:1'],
            'cart_items.*.mrp' => ['required', 'numeric', 'min:0'],
            'cart_items.*.cost' => ['required', 'numeric', 'min:0'],
        ]);
        try {
            DB::transaction(function () use ($request, $purchase) {

                $grand_total = doubleval($request->grand_total);

                $purchase->update([
                    PurchaseTable::DATE => $request->purchase_date,
                    PurchaseTable::REFERENCE_NUMBER => $request->reference,
                    PurchaseTable::SUPPLIER_ID => $request->supplier,
                    PurchaseTable::OTHER_AMOUNT => doubleval($request->other_charges),
                    PurchaseTable::DISCOUNT => doubleval($request->discount),
                    PurchaseTable::TOTAL_AMOUNT => $grand_total,
                    PurchaseTable::ORDER_STATUS => $request->status,
                    PurchaseTable::PURCHASE_NOTE => $request->note ?? "no notes.",
                    PurchaseTable::FINANCE_YEAR => $this->getFinanceYear()
                ]);

                // Delete existing purchase items
                $purchase->purchaseItems()->delete();

                $cartItem = [];

                foreach ($request->cart_items as $item) {
                    $data[PurchaseItemTable::PURCHASE_ID] = $purchase->id;
                    $data[PurchaseItemTable::PRODUCT_ID] = intval($item['id']);
                    $data[PurchaseItemTable::QUANTITY] = intval($item['quantity']);
                    $data[PurchaseItemTable::MRP] = doubleval($item['mrp']);
                    $data[PurchaseItemTable::COST] = doubleval($item['cost']);
                    $data[PurchaseItemTable::STATUS] = $purchase->order_status === OrderStatusEnum::RECEIVED ? 1 : 0;
                    $data[PurchaseItemTable::FINANCE_YEAR] = $this->getFinanceYear();
                    $data['created_at'] = Carbon::now();
                    $cartItem[] = $data;
                }
                PurchaseItem::insert($cartItem);
            });

            return redirect()->route('purchases.index')->with('success', 'Update Success');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        try {
            $purchase->purchaseItems()->delete();
            $purchase->delete();
            return redirect()->route('purchases.index')->with('success', 'Delete Success');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
}
