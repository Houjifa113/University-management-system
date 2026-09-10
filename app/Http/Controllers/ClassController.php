<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\StoreClassStudentAssignmentRequest;
use App\Models\Classlist;
use App\Models\studentlist;
use App\Models\teacherlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $classes = Classlist::query()
            ->with('teacher')
            ->withCount('students')
            ->orderBy('class_name')
            ->get();

        return view('classList', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacher = teacherlist::find(session('class_teacher_id'));
        $students = studentlist::whereIn('id', session('class_student_ids', []))->get();

        return view('createClass', compact('teacher', 'students'));
    }

    public function assignTeacher()
    {
        $teachers = teacherlist::query()
            ->orderBy('name')
            ->get();

        return view('assignTeacher', compact('teachers'));
    }

    public function storeTeacherAssignment(teacherlist $teacher)
    {
        session(['class_teacher_id' => $teacher->id]);

        return redirect()->route('class.create')
            ->with('success', "$teacher->name has been selected for this class.");
    }

    public function assignStudent()
    {
        $students = studentlist::query()
            ->orderBy('username')
            ->get();

        $selectedStudentIds = session('class_student_ids', []);

        return view('assignStudent', compact('students', 'selectedStudentIds'));
    }

    public function storeStudentAssignment(StoreClassStudentAssignmentRequest $request)
    {
        $studentIds = $request->validated('student_ids');

        session(['class_student_ids' => $studentIds]);

        return redirect()->route('class.create')
            ->with('success', 'Selected students have been assigned to this class.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassRequest $request): RedirectResponse
    {
        $teacher = teacherlist::find(session('class_teacher_id'));
        $studentIds = session('class_student_ids', []);

        if (! $teacher) {
            return back()->withErrors(['teacher' => 'Please assign a teacher before creating the class.']);
        }

        if ($studentIds === []) {
            return back()->withErrors(['students' => 'Please assign at least one student before creating the class.']);
        }

        $class = DB::transaction(function () use ($request, $teacher, $studentIds): Classlist {
            $class = Classlist::create([
                ...$request->validated(),
                'Teacher_Name' => $teacher->name,
                'teacher_id' => $teacher->id,
            ]);

            $class->students()->attach($studentIds);

            return $class;
        });

        session()->forget(['class_teacher_id', 'class_student_ids']);

        return redirect()->route('class.show', $class)
            ->with('success', 'The class has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classlist $classlist): View
    {
        $classlist->load(['teacher', 'students']);

        return view('classDetails', compact('classlist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
