<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\CategoriesTable;
use App\Enums\DatabaseEnum\ProductTable;
use App\Enums\DatabaseEnum\StockTable;
use App\Enums\DatabaseEnum\UnitTable;
use App\Enums\ImageEnum;
use App\Filters\ByOrCode;
use App\Filters\ByName;
use App\Http\Resources\ProductResource;
use App\Models\Categories;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $productQuery = Product::query()->with('category', 'unit','stocks')->where(ProductTable::FINANCE_YEAR, $this->getFinanceYear());

        $products = Pipeline::send($productQuery)->through([
            ByOrCode::class,
            ByName::class,
        ])->thenReturn()->paginate(5)->withQueryString();
        return Inertia::render('Product/List', ['products' => ProductResource::collection($products)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::where(UnitTable::FINANCE_YEAR, $this->getFinanceYear())->latest()->get();
        $categories = Categories::where(CategoriesTable::FINANCE_YEAR, $this->getFinanceYear())->get();
        return Inertia::render('Product/Create', ['units' => $units, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ["required", "string", Rule::unique(Product::class, 'code')],
            'name' => ["required", "string"],
            'description' => ["required", "string"],
            'mrp' => ["required", "numeric"],
            'cost' => ["required", "numeric"],
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'category' => ["required", Rule::exists(Categories::class, 'id')],
            'unit' => ["required", Rule::exists(Unit::class, 'id')],
        ]);

        try {

            $data = [
                ProductTable::CODE => $request->code,
                ProductTable::NAME => $request->name,
                ProductTable::DESCRIPTION => $request->description,
                ProductTable::MRP => $request->mrp ?? 0,
                ProductTable::COST => $request->cost ?? 0,
                ProductTable::IMAGE => ImageEnum::NO_PRODUCT_IMAGE,
                ProductTable::CATEGORIES => $request->category,
                ProductTable::UNIT => $request->unit,
                ProductTable::FINANCE_YEAR => $this->getFinanceYear(),
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $data[ProductTable::IMAGE] = $this->imageManager->loadFile($image->getRealPath())->width(200)->height(200)->base64();
            }

            $product = Product::create($data);
            Stock::create([
                StockTable::PRODUCT_ID => $product->id,
                StockTable::QUANTITY => 0,
                StockTable::FINANCE_YEAR => $this->getFinanceYear(),
            ]);

            return redirect()->route('products.index')->with('success', 'Create success');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $units = Unit::where(UnitTable::FINANCE_YEAR, $this->getFinanceYear())->latest()->get();
        $categories = Categories::where(CategoriesTable::FINANCE_YEAR, $this->getFinanceYear())->get();
        return Inertia::render('Product/Edit', ['product' => $product, 'units' => $units, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => ["required", "string", Rule::unique(Product::class, 'code')->ignore($product->id)],
            'name' => ["required", "string"],
            'description' => ["required", "string"],
            'mrp' => ["required", "numeric"],
            'cost' => ["required", "numeric"],
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'category' => ["required", Rule::exists(Categories::class, 'id')],
            'unit' => ["required", Rule::exists(Unit::class, 'id')],
        ]);

        try {

            $data = [
                ProductTable::CODE => $request->code ?? $product->code,
                ProductTable::NAME => $request->name ?? $product->name,
                ProductTable::DESCRIPTION => $request->description ?? $product->description,
                ProductTable::MRP => $request->mrp ?? $product->mrp,
                ProductTable::COST => $request->cost ?? $product->cost,
                ProductTable::CATEGORIES => $request->category ?? $product->categories,
                ProductTable::UNIT => $request->unit ?? $product->unit,
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $data[ProductTable::IMAGE] = $this->imageManager->loadFile($image->getRealPath())->width(200)->height(200)->base64();
            }

            $product->update($data);

            return redirect()->route('products.index')->with('success', 'Create success');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->back()->with('success', 'Delete success');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('danger', $e->getMessage());
        }
    }
}
