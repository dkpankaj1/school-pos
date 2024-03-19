<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\StudentClassTable;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Classes/List",[
            'classes' => StudentClass::where(StudentClassTable::FINANCE_YEAR,$this->getFinanceYear())->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Classes/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> ["required" ,Rule::unique(StudentClass::class,StudentClassTable::NAME)],
        ]);

        try {
            StudentClass::create([
                StudentClassTable::NAME => $request->name,
                StudentClassTable::DESCRIPTION => $request->description ?? "No description",
                StudentClassTable::FINANCE_YEAR => $this->getFinanceYear()
            ]);
            return redirect()->route('student-class.index')->with('success', 'Create Success');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentClass $student_class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentClass $student_class)
    {
        return Inertia::render("Classes/Edit",[
            'classes' => $student_class
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentClass $student_class)
    {
        $request->validate([
            "name"=> ["required" ,Rule::unique(StudentClass::class,StudentClassTable::NAME)->ignore($student_class->id)],
        ]);

        try {
            $student_class->update([
                StudentClassTable::NAME => $request->name ?? $student_class->name,
                StudentClassTable::DESCRIPTION => $request->description ?? $student_class->description,
            ]);
            return redirect()->route('student-class.index')->with('success', 'Update Success');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentClass $student_class)
    {
        try {
            $student_class->delete();           
            return redirect()->route('student-class.index')->with('success', 'Delete Success');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
