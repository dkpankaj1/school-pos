<?php

namespace App\Http\Controllers;

use App\Enums\DatabaseEnum\StudentClassTable;
use App\Enums\DatabaseEnum\StudentTable;
use App\Filters\ByOrEnrolmentNumber;
use App\Filters\ByName;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $studentQuery = Student::query()->with('classes')->where(StudentTable::FINANCE_YEAR,$this->getFinanceYear());

        $students = Pipeline::send($studentQuery)->through([
            ByOrEnrolmentNumber::class,
            ByName::class
        ])->thenReturn();
        

        return Inertia::render("Student/List",[
            "students" => $students->latest()->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Student/Create',['classes' =>StudentClass::where(StudentClassTable::FINANCE_YEAR,$this->getFinanceYear())->latest()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required'],
            'enrolment'=> ['required',Rule::unique(Student::class,StudentTable::ENROLMENT_NO)],
            'father'=> ['required'],
            'class'=> ['required',Rule::exists(StudentClass::class,'id')],
            'remark'=> ['sometimes'],
        ]);
        try {
            Student::create([
                StudentTable::NAME =>$request->name,
                StudentTable::ENROLMENT_NO =>$request->enrolment,
                StudentTable::CLASSES =>$request->class,
                StudentTable::FATHER =>$request->father,
                StudentTable::REMARK =>$request->remark ?? "No Remark",
                StudentTable::FINANCE_YEAR => $this->getFinanceYear()
            ]);
            
            return redirect()->route('student.index')->with('success', 'Create Success');

        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return Inertia::render("Student/Edit",[
            "student" => $student,
            'classes' =>StudentClass::where(StudentClassTable::FINANCE_YEAR,$this->getFinanceYear())->latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'=> ['required'],
            'enrolment'=> ['required',Rule::unique(Student::class,StudentTable::ENROLMENT_NO)->ignore($student->id)],
            'father'=> ['required'],
            'class'=> ['required',Rule::exists(StudentClass::class,'id')],
            'remark'=> ['sometimes'],
        ]);
        try {
            $student->update([
                StudentTable::NAME =>$request->name ?? $student->name,
                StudentTable::ENROLMENT_NO =>$request->name ?? $student->enrolment_no,
                StudentTable::CLASSES =>$request->class ?? $student->class,
                StudentTable::FATHER =>$request->father ?? $student->father,
                StudentTable::REMARK =>$request->remark ?? $student->remark,
            ]);
            
            return redirect()->route('student.index')->with('success', 'Create Success');

        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return redirect()->back()->with('success', 'Delete Success');

        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
}
