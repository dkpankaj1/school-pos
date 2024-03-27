<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\ProductTable;
use App\Enums\DatabaseEnum\QuotationItemsTable;
use App\Enums\DatabaseEnum\QuotationTable;
use App\Http\Resources\CreateQuotationResource;
use App\Http\Resources\EditQuotationResource;
use App\Http\Resources\QuotationResource;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\QuotationItems;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::where(QuotationTable::FINANCE_YEAR,$this->getFinanceYear())->latest()->paginate(10)->withQueryString();

        return Inertia::render("Quotation/List",[
            'quotations' => QuotationResource::collection($quotations)
        ]);
    }
    public function create()
    {

        $products = Product::query()
            ->where(ProductTable::FINANCE_YEAR, $this->getFinanceYear())
            ->with(['unit','category'])
            ->get();

        return Inertia::render("Quotation/Create", [
            "products" => CreateQuotationResource::collection($products)
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'code' => ['required', 'string',Rule::unique(Quotation::class,'code')],
            'other_charges' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'grand_total' => ['required', 'numeric', 'min:0'],
            'cart_items' => ['required', 'array'],
            'cart_items.*.id' => ['required', 'integer', Rule::exists(Product::class, 'id')],
            'cart_items.*.quantity' => ['required', 'integer', 'min:1'],
            'cart_items.*.mrp' => ['required', 'numeric', 'min:0'],
        ]);

        try {
            DB::transaction(function () use ($request) {

                $quotation = Quotation::create([
                    QuotationTable::DATE => $request->date,
                    QuotationTable::CODE => $request->code,
                    QuotationTable::OTHER_AMOUNT => $request->other_charges,
                    QuotationTable::DISCOUNT => $request->discount,
                    QuotationTable::TOTAL_AMOUNT => 0,
                    QuotationTable::FINANCE_YEAR => $this->getFinanceYear()

                ]);

                $quotationItem = [];

                foreach ($request->cart_items as $item) {
                    $quotationItem[] = [
                        QuotationItemsTable::QUOTATION_ID => $quotation->id,
                        QuotationItemsTable::PRODUCT_ID => $item['id'],
                        QuotationItemsTable::QUANTITY => intval($item['quantity']),
                        QuotationItemsTable::MRP => doubleval($item['mrp']),
                        QuotationItemsTable::FINANCE_YEAR => $this->getFinanceYear(),
                        'created_at' => Carbon::now(),
                    ];
                }

                QuotationItems::insert($quotationItem);

                // Calculate grand total after all items are processed
                $grandTotal = collect($quotationItem)->sum(function ($item) {
                    return $item[QuotationItemsTable::MRP] * $item[QuotationItemsTable::QUANTITY];
                });

                // Update grand total in the sale record
                $quotation->update([
                    QuotationTable::TOTAL_AMOUNT => $grandTotal + $quotation->other_amount - $quotation->discount,
                ]);
            });

            return redirect()->route('quotations.index')->with('success', 'Create Success');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
    public function edit(Quotation $quotation)
    {
        $products = Product::query()
        ->where(ProductTable::FINANCE_YEAR, $this->getFinanceYear())
        ->with(['unit','category'])
        ->get();

        return Inertia::render("Quotation/Edit",[
            'quotation' => new EditQuotationResource($quotation),
            "products" => CreateQuotationResource::collection($products)
        ]);
    }
    public function update(Request $request, Quotation $quotation)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'code' => ['required', 'string',Rule::unique(Quotation::class,'code')->ignore($quotation->id)],
            'other_charges' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'grand_total' => ['required', 'numeric', 'min:0'],
            'cart_items' => ['required', 'array'],
            'cart_items.*.id' => ['required', 'integer', Rule::exists(Product::class, 'id')],
            'cart_items.*.quantity' => ['required', 'integer', 'min:1'],
            'cart_items.*.mrp' => ['required', 'numeric', 'min:0'],
        ]);

        try {
            DB::transaction(function () use ($request,$quotation) {


                $quotation->items()->delete();


                $quotation->update([
                    QuotationTable::DATE => $request->date ?? $quotation->date,
                    QuotationTable::CODE => $request->code ?? $quotation->code,
                    QuotationTable::OTHER_AMOUNT => $request->other_charges ?? $quotation->other_charges,
                    QuotationTable::DISCOUNT => $request->discount ?? $quotation->discount,

                ]);

                $quotationItem = [];

                foreach ($request->cart_items as $item) {
                    $quotationItem[] = [
                        QuotationItemsTable::QUOTATION_ID => $quotation->id,
                        QuotationItemsTable::PRODUCT_ID => $item['id'],
                        QuotationItemsTable::QUANTITY => intval($item['quantity']),
                        QuotationItemsTable::MRP => doubleval($item['mrp']),
                        QuotationItemsTable::FINANCE_YEAR => $this->getFinanceYear(),
                        'created_at' => Carbon::now(),
                    ];
                }

                QuotationItems::insert($quotationItem);

                // Calculate grand total after all items are processed
                $grandTotal = collect($quotationItem)->sum(function ($item) {
                    return $item[QuotationItemsTable::MRP] * $item[QuotationItemsTable::QUANTITY];
                });

                // Update grand total in the sale record
                $quotation->update([
                    QuotationTable::TOTAL_AMOUNT => $grandTotal + $quotation->other_amount - $quotation->discount,
                ]);
            });

            return redirect()->route('quotations.index')->with('success', 'update Success');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
    public function destroy(Quotation $quotation)
    {
    }
}
