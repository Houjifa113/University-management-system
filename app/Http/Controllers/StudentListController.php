<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportStudentCsvRequest;
use App\Http\Requests\StudentFormRequest;
use App\Models\StudentList;
use App\Models\user_role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StudentListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentlist = StudentList::query()
            ->paginate(5)
            ->appends(['sort' => 'department']);

        return view('student.student_list', [
            'data' => $studentlist,
            'studentlist' => $studentlist,
        ]);
    }

    public function search(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $students = StudentList::query()
            ->when($search !== '', function ($query) use ($search) {
                return $query->where('username', 'like', "%{$search}%");
            })
            ->orderBy('username')
            ->get();

        return view('partials.student_search_results', compact('students'));
    }

    public function import(ImportStudentCsvRequest $request): RedirectResponse
    {
        $students = $request->students();
        DB::transaction(function () use ($students): void {
            foreach ($students as $studentData) {
                $temporaryPassword = Str::password(12, letters: true, numbers: true, symbols: false);

                $student = new StudentList;
                $student->username = $studentData['username'];
                $student->email = $studentData['email'];
                $student->password = Hash::make($temporaryPassword);
                $student->temporary_password = $temporaryPassword;
                $student->gender = $studentData['gender'];
                $student->department = $studentData['department'];
                $student->role_id = user_role::STUDENT_ID;
                $student->save();
            }
        });

        return redirect()->route('studentlist')
            ->with('success', count($students).' students imported successfully. Each student can find their temporary password in their profile after signing in.');
    }

    public function export()
    {
        return response()->streamDownload(function (): void {
            $file = fopen('php://output', 'w');

            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['ID', 'Username', 'Email', 'Gender', 'Department', 'Role', 'Class ID', 'Role ID']);

            DB::table('student_lists')
                ->select(['id', 'username', 'email', 'gender', 'department', 'role', 'class_id', 'role_id'])
                ->orderBy('id')
                ->eachById(function (object $student) use ($file): void {
                    fputcsv($file, [
                        $student->id,
                        $student->username,
                        $student->email,
                        $student->gender,
                        $student->department,
                        $student->role,
                        $student->class_id,
                        $student->role_id,
                    ]);
                });

            fclose($file);
        }, 'students_report_'.now()->format('Y-m-d').'.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentFormRequest $request)
    {
        $validated = $request->validated();

        $student = new StudentList;
        $student->username = $validated['username'];
        $student->email = $validated['email'];
        $student->password = Hash::make($validated['password']);
        $student->gender = $validated['gender'];
        $student->department = $validated['designation'];
        $student->role_id = user_role::STUDENT_ID;
        $student->image = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;
        $student->save();

        return redirect()->route('form')
            ->with('success', 'Student added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentList $student)
    {
        return view('student.student_profile', ['student' => $student]);
    }

    public function classes(StudentList $student): View
    {
        $classes = $student->classes()
            ->with('teacher')
            ->orderBy('class_name')
            ->get();

        return view('student.student_classes', compact('student', 'classes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentList $student)
    {
        return view('student.update_student_list', ['studentlist' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentFormRequest $request, StudentList $student)
    {
        $validated = $request->validated();

        if (! Auth::guard('student')->check()) {
            foreach (['username', 'email', 'gender'] as $field) {
                if (! empty($validated[$field])) {
                    $student->{$field} = $validated[$field];
                }
            }

            if (! empty($validated['designation'])) {
                $student->department = $validated['designation'];
            }
        }

        if ($validated['password'] ?? false) {
            $student->password = Hash::make($validated['password']);
            $student->temporary_password = null;
        }

        if ($request->hasFile('image')) {
            $student->image = $request->file('image')->store('images', 'public');
        }

        $student->save();

        if (Auth::guard('student')->check()) {
            return redirect()->route('student.profile', $student)
                ->with('success', 'Your profile was updated successfully.');
        }

        return redirect()->route('studentlist')
            ->with('success', 'Student information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentList $student)
    {
        $student->delete();

        return redirect()->route('studentlist');
    }
}
