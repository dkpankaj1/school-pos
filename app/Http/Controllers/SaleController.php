<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\SaleTable;
use App\Enums\DatabaseEnum\StockTable;
use App\Enums\DatabaseEnum\StudentClassTable;
use App\Http\Resources\StockResource;
use App\Http\Resources\StudentClassWithStudentResource;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Sales/List',[
            'sales' => Sale::where(SaleTable::FINANCE_YEAR,$this->getFinanceYear())->latest()->paginate(10)->withQueryString()
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

        return Inertia::render('Sales/Create',[
            'stocks' => $stocks,
            'classes' => $classWithStudent,
            'currentData' =>  date("Y-m-d")
        ]);

    }
    public function store(Request $request)
    {

    }
    public function show(Sale $sale)
    {

    }
    public function edit(Sale $sale)
    {

    }
    public function update(Request $request, Sale $sale)
    {

    }
    public function destroy(Sale $sale)
    {

    }

}
