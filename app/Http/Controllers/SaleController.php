<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\SaleItemTable;
use App\Enums\DatabaseEnum\SaleTable;
use App\Enums\DatabaseEnum\StockTable;
use App\Enums\DatabaseEnum\StudentClassTable;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Filters\ByReference;
use App\Helpers\Helpers;
use App\Http\Resources\SaleResource;
use App\Http\Resources\SaleWithDetailResource;
use App\Http\Resources\StockResource;
use App\Http\Resources\StudentClassWithStudentResource;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Stock;
use App\Models\Student;
use App\Models\StudentClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function index(Request $request)
    {

        $saleQuery = Sale::where(SaleTable::FINANCE_YEAR, $this->getFinanceYear());
        $saleQuery = Pipeline::send($saleQuery)->through([
            ByReference::class,
        ])->thenReturn();

        return Inertia::render('Sales/List', [
            'sales' => SaleResource::collection($saleQuery->latest()->paginate(10)->withQueryString()),
        ]);
    }
    public function create()
    {
        $stocks = StockResource::collection(Stock::with('product')
            ->where(StockTable::FINANCE_YEAR, $this->getFinanceYear())
            ->where('quantity', '>', 0)
            ->get());

        $classWithStudent = StudentClassWithStudentResource::collection(StudentClass::where(
            StudentClassTable::FINANCE_YEAR,
            $this->getFinanceYear()
        )
            ->with('students')
            ->get());

        return Inertia::render('Sales/Create', [
            'stocks' => $stocks,
            'classes' => $classWithStudent,
            'currentData' => date("Y-m-d")
        ]);

    }
    public function store(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'status' => ['required', 'string', Rule::in([OrderStatusEnum::RECEIVED, OrderStatusEnum::PENDING, OrderStatusEnum::ORDER])],
            'other_charges' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'grand_total' => ['required', 'numeric', 'min:0'],
            'student' => ['required', Rule::exists(Student::class, 'id')],
            'cart_items' => ['required', 'array'],
            'cart_items.*.id' => ['required', 'exists:products,id'],
            'cart_items.*.mrp' => ['required', 'numeric', 'min:0'],
            'cart_items.*.quantity' => ['required', 'numeric', 'min:1'],
            'note' => ['nullable', 'string'],
        ]);

        try {
            DB::transaction(function () use ($request) {
                $grandTotal = 0;
                $saleItems = [];

                $saleRecord = Sale::create([
                    SaleTable::DATE => $request->date,
                    SaleTable::REFERENCE_NUMBER => 'INV_' . time(), // Prefixing with 'INV_'
                    SaleTable::STUDENT_ID => $request->student,
                    SaleTable::OTHER_AMOUNT => $request->other_charges ?? 0,
                    SaleTable::DISCOUNT => $request->discount ?? 0,
                    SaleTable::TOTAL_AMOUNT => $request->grand_total,
                    SaleTable::PAID_AMOUNT => 0,
                    SaleTable::ORDER_STATUS => $request->status,
                    SaleTable::PAYMENT_STATUS => PaymentStatusEnum::PENDING,
                    SaleTable::NOTE => $request->note ?? "no notes",
                    SaleTable::FINANCE_YEAR => $this->getFinanceYear(),
                ]);

                foreach ($request->cart_items as $cart_item) {
                    $saleItems[] = [
                        SaleItemTable::SALE_ID => $saleRecord->id,
                        SaleItemTable::PRODUCT_ID => $cart_item['id'],
                        SaleItemTable::MRP => floatval($cart_item['mrp']),
                        SaleItemTable::QUANTITY => intval($cart_item['quantity']),
                        'created_at' => Carbon::now(), // Set creation timestamp
                        SaleItemTable::FINANCE_YEAR => $this->getFinanceYear(),
                    ];
                }

                // Bulk insert sale items
                SaleItem::insert($saleItems);

                // Calculate grand total after all items are processed
                $grandTotal = collect($saleItems)->sum(function ($item) {
                    return $item[SaleItemTable::MRP] * $item[SaleItemTable::QUANTITY];
                });

                // Update grand total in the sale record
                $saleRecord->update([
                    SaleTable::TOTAL_AMOUNT => $grandTotal + $saleRecord->other_amount - $saleRecord->discount,
                ]);

                // Update stock if the order status is 'RECEIVED'
                if ($saleRecord->order_status === OrderStatusEnum::RECEIVED) {
                    foreach ($saleItems as $item) {
                        $stockResult = Stock::where([
                            StockTable::PRODUCT_ID => $item[SaleItemTable::PRODUCT_ID],
                            StockTable::FINANCE_YEAR => $this->getFinanceYear()
                        ])->first();

                        if ($stockResult) {
                            $stockResult->quantity -= $item[SaleItemTable::QUANTITY];
                            $stockResult->save();
                        }
                    }
                }
            });

            return redirect()->route('sales.index')->with('success', 'created success.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function show(Sale $sale)
    {

    }
    public function edit(Sale $sale)
    {
        $stocks = StockResource::collection(Stock::with('product')
            ->where(StockTable::FINANCE_YEAR, $this->getFinanceYear())
            ->where('quantity', '>', 0)
            ->get());

        $classWithStudent = StudentClassWithStudentResource::collection(StudentClass::where(
            StudentClassTable::FINANCE_YEAR,
            $this->getFinanceYear()
        )
            ->with('students')
            ->get());

        return Inertia::render('Sales/Edit', [
            'stocks' => $stocks,
            'classes' => $classWithStudent,
            'sale' => new SaleWithDetailResource($sale)

        ]);
    }
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'status' => ['required', 'string', Rule::in([OrderStatusEnum::RECEIVED, OrderStatusEnum::PENDING, OrderStatusEnum::ORDER])],
            'other_charges' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'grand_total' => ['required', 'numeric', 'min:0'],
            'cart_items' => ['required', 'array'],
            'cart_items.*.id' => ['required', 'exists:products,id'],
            'cart_items.*.mrp' => ['required', 'numeric', 'min:0'],
            'cart_items.*.quantity' => ['required', 'numeric', 'min:1'],
            'note' => ['nullable', 'string'],
        ]);

        try {
            DB::transaction(function () use ($request, $sale) {
                $grandTotal = 0;

                // revert sale 
                if ($sale->order_status === OrderStatusEnum::RECEIVED) {
                    foreach ($sale->saleItems as $item) {
                        $stockResult = Stock::where([
                            StockTable::PRODUCT_ID => $item->product_id,
                            StockTable::FINANCE_YEAR => $sale->finance_year_id
                        ])->first();
                        if ($stockResult) {
                            $stockResult->quantity += $item->quantity;
                            $stockResult->save();
                        }
                    }
                }
                // delete sale items
                $sale->saleItems()->delete();

                $sale->update([
                    SaleTable::DATE => $request->date ?? $sale->date,
                    SaleTable::OTHER_AMOUNT => $request->other_charges ?? $sale->other_amount,
                    SaleTable::DISCOUNT => $request->discount ?? $sale->discount,
                    SaleTable::TOTAL_AMOUNT => $request->grand_total ?? $sale->total_amount,
                    SaleTable::ORDER_STATUS => $request->status ?? $sale->order_status,
                    SaleTable::NOTE => $request->note ?? $sale->notes,
                ]);

                foreach ($request->cart_items as $cart_item) {
                    $saleItemsArr[] = [
                        SaleItemTable::SALE_ID => $sale->id,
                        SaleItemTable::PRODUCT_ID => $cart_item['id'],
                        SaleItemTable::MRP => floatval($cart_item['mrp']),
                        SaleItemTable::QUANTITY => intval($cart_item['quantity']),
                        'updated_at' => Carbon::now(), // Set creation timestamp
                        SaleItemTable::FINANCE_YEAR => $this->getFinanceYear(),
                    ];
                }

                // Bulk insert sale items
                SaleItem::insert($saleItemsArr);

                // Calculate grand total after all items are processed
                $grandTotal = collect($saleItemsArr)->sum(function ($item) {
                    return $item[SaleItemTable::MRP] * $item[SaleItemTable::QUANTITY];
                });

                // Update grand total in the sale record
                $sale->update([
                    SaleTable::TOTAL_AMOUNT => $grandTotal + $sale->other_amount - $sale->discount,
                    SaleTable::PAYMENT_STATUS => Helpers::getPaymentStatus(($grandTotal + $sale->other_amount) - $sale->discount, $sale->paid_amount),
                ]);

                // Update stock if the order status is 'RECEIVED'
                if ($sale->order_status === OrderStatusEnum::RECEIVED) {
                    foreach ($saleItemsArr as $item) {
                        $stockResult = Stock::where([
                            StockTable::PRODUCT_ID => $item[SaleItemTable::PRODUCT_ID],
                            StockTable::FINANCE_YEAR => $this->getFinanceYear()
                        ])->first();

                        if ($stockResult) {
                            $stockResult->quantity -= $item[SaleItemTable::QUANTITY];
                            $stockResult->save();
                        }
                    }
                }
            });

            return redirect()->route('sales.index')->with('success', 'Update successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
    public function destroy(Sale $sale)
    {
        try {
            DB::transaction(function () use ($sale) {
                // revert sale 
                if ($sale->order_status === OrderStatusEnum::RECEIVED) {
                    foreach ($sale->saleItems as $item) {
                        $stockResult = Stock::where([
                            StockTable::PRODUCT_ID => $item->product_id,
                            StockTable::FINANCE_YEAR => $sale->finance_year_id
                        ])->first();
                        if ($stockResult) {
                            $stockResult->quantity += $item->quantity;
                            $stockResult->save();
                        }
                    }
                }
                // delete sale items
                $sale->saleItems()->delete();
                $sale->payments()->delete();
                $sale->delete();
            });

            return redirect()->route('sales.index')->with('success', 'Delete successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function print(Sale $sale)
    {
        $pdf = Pdf::loadView('pdf.sale.invoice', [
            'sale' => $sale,
            'symbol' => 'INR'
        ])->setPaper('a5');

        return $pdf->download('Invoice_'.$sale->reference_number.'.pdf');
        
    }

}
