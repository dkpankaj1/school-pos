<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnitResource;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Enums\DatabaseEnum\UnitTable;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UnitController extends Controller
{

    public function index()
    {
        return Inertia::render("Unit/List", [
            'units' => UnitResource::collection(Unit::where(UnitTable::FINANCE_YEAR, $this->getFinanceYear())->latest()->get())
        ]);
    }

    public function create()
    {
        return Inertia::render('Unit/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string',Rule::unique(Unit::class, UnitTable::NAME)],
            'short_name' => ['required', 'string', Rule::unique(Unit::class, UnitTable::SHORTNAME)],
        ]);

        try {
            Unit::create([
                UnitTable::NAME => $request->name,
                UnitTable::SHORTNAME => $request->short_name,
                UnitTable::DESCRIPTION => $request->description ?? "no description",
                UnitTable::FINANCE_YEAR => $this->getFinanceYear(),
            ]);

            return redirect()->route('units.index')->with('success', 'Create success');
        } catch (\Exception $e) {
            return redirect()->route('units.index')->with('danger', $e->getMessage());

        }
    }

    public function show(Unit $unit)
    {
        //
    }

    public function edit(Unit $unit)
    {
        return Inertia::render('Unit/Edit',['unit' => $unit]);
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => ['required', 'string',Rule::unique(Unit::class, UnitTable::NAME)->ignore($unit->id)],
            'short_name' => ['required', 'string', Rule::unique(Unit::class, UnitTable::SHORTNAME)->ignore($unit->id)],
        ]);

        try {
           $unit->update([
                UnitTable::NAME => $request->name,
                UnitTable::SHORTNAME => $request->short_name,
                UnitTable::DESCRIPTION => $request->description ?? "no description",
            ]);

            return redirect()->route('units.index')->with('success', 'Update success');
        } catch (\Exception $e) {
            return redirect()->route('units.index')->with('danger', $e->getMessage());

        }
    }

    public function destroy(Unit $unit)
    {
        try {
            $unit->delete();
            return redirect()->route('units.index')->with('success', 'delete success');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
}
