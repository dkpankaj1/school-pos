<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriesResource;
use App\Models\Categories;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Enums\DatabaseEnum\CategoriesTable;
use Inertia\Inertia;

class CategoriesController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render("Categories/List", ['categories' => CategoriesResource::collection(Categories::where(CategoriesTable::FINANCE_YEAR,$this->getFinanceYear())->get())]);
    }

    public function create()
    {
        return Inertia::render("Categories/Create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => ['required'],
        ]);

        try {
            Categories::create([
                CategoriesTable::NAME => $request->name,
                CategoriesTable::DESCRIPTION => $request->description ?? "No description",
                CategoriesTable::FINANCE_YEAR => $this->getFinanceYear(),
            ]);
            return redirect()->route('categories.index')->with('success', 'Categories Create Success');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


    }

    public function show(Categories $category)
    {
    }

    public function edit(Categories $category)
    {
        return Inertia::render("Categories/Edit", ['category' => $category]);
    }

    public function update(Request $request, Categories $category)
    {
        $request->validate([
            "name" => ['required'],
        ]);

        try {
            $category->update([
                CategoriesTable::NAME => $request->name ?? $category->name,
                CategoriesTable::DESCRIPTION => $request->description ?? $category->description,
            ]);

            return redirect()->route('categories.index')->with('success', 'Categories Update Success');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Categories $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Categories Delete Success');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
