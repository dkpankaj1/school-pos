<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\SalePaymentTable;
use App\Enums\PaymentMethodEnum;
use App\Helpers\Helpers;
use App\Http\Resources\SalePaymentResource;
use App\Models\Sale;
use App\Models\SalePayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SalePaymentController extends Controller
{

    public function index(Sale $sale)
    {
        $payments = SalePayment::where(SalePaymentTable::SALE_ID, $sale->id)->get();

        return Inertia::render("Sales/PaymentList", [
            'payments' => SalePaymentResource::collection($payments),
        ]);
    }

    public function create(Sale $sale)
    {
        // check payment is paid or not

        $due = $sale->total_amount - $sale->paid_amount;

        if ($due === 0.0 || $due <= 0) {
            return redirect()->back()->with('danger', 'payment already paid');
        }

        $saleData = [
            'id' => $sale->id,
            'date' => Carbon::parse($sale->date)->format('Y-m-d'),
            'reference_number' => $sale->reference_number,
            'student' => $sale->student->name,
            'amount' => $sale->total_amount - $sale->paid_amount,
            'current' => Carbon::now()->format('Y-m-d'),
        ];
        return Inertia::render('Sales/Payment', [
            'sale' => $saleData
        ]);
    }
    public function store(Request $request, Sale $sale)
    {
        $request->validate([
            'payment_date' => ['required'],
            'paid_amount' => ['required'],
            'payment_method' => ['required', 'string', Rule::in(PaymentMethodEnum::getValues())],
        ]);

        try {

            // if payment is not paid then check paid amount is grater then  due amount

            if ($sale->total_amount < ($sale->paid_amount + $request->paid_amount)) {
                return redirect()->back()->with('danger', 'amount not accepted.');
            }


            DB::transaction(function () use ($request, $sale) {

                $salePayment = SalePayment::create([
                    SalePaymentTable::DATE => $request->payment_date,
                    SalePaymentTable::SALE_ID => $sale->id,
                    SalePaymentTable::AMOUNT => $request->paid_amount,
                    SalePaymentTable::PAYMENT_METHOD => $request->payment_method
                ]);
                $sale->update([
                    'paid_amount' => ($sale->paid_amount + $salePayment->amount),
                    'payment_status' => Helpers::getPaymentStatus($sale->total_amount, ($sale->paid_amount + $salePayment->amount))
                ]);
            });

            return redirect()->route('sales.index')->with('success', 'payment success.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function destroy(SalePayment $payment)
    {
        try {

            DB::transaction(function () use ($payment) {
                $payment->sale->update([
                    'paid_amount' => ($payment->sale->paid_amount - $payment->amount),
                    'payment_status' => Helpers::getPaymentStatus($payment->sale->total_amount, ($payment->sale->paid_amount + $payment->amount))
                ]);

                $payment->delete();
            });

            return redirect()->back()->with('success', 'payment delete success.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
}
