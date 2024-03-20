<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\ProductTable;
use App\Enums\DatabaseEnum\StudentTable;
use App\Enums\DatabaseEnum\SupplierTable;
use App\Models\Product;
use App\Models\Student;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {

        $dashboardData = [
            'student' => Student::where(StudentTable::FINANCE_YEAR,$this->getFinanceYear())->latest()->take(10)->get(),
            'studentCount' => Student::where(StudentTable::FINANCE_YEAR,$this->getFinanceYear())->count(),
            'supplierCount'=> Supplier::where(SupplierTable::FINANCE_YEAR,$this->getFinanceYear())->count(),
            'productCount'=> Product::where(ProductTable::FINANCE_YEAR,$this->getFinanceYear())->count(),
        ];

        return Inertia::render('Dashboard/Dashboard',
        [
            'dashboardData' => $dashboardData
        ]
    );
    }
}
