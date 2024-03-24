<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\ProductTable;
use App\Filters\ByName;
use App\Filters\ByOrCode;
use App\Models\Product;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;

class SearchProductController extends Controller
{
    use HttpResponses;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $productQuery = Product::query()->with('category', 'unit')->where(ProductTable::FINANCE_YEAR, $this->getFinanceYear());

        $products = Pipeline::send($productQuery)->through([
            ByOrCode::class,
            ByName::class,
        ])->thenReturn()->select(['id','name','code'])->get();

       return $this->sendSuccess('search product result', $products,200);
    }
}
