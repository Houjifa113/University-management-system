<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherFormRequest;
use App\Models\TeacherList;
use App\Models\user_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class TeacherListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherlist = TeacherList::query()
            ->paginate(5)
            ->appends(['sort' => 'department']);

        return view('teacher.teacher_list', compact('teacherlist'));
    }

    public function search(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $teachers = TeacherList::query()
            ->when($search !== '', function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->get();

        return view('partials.teacher_search_results', compact('teachers'));
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
    public function store(TeacherFormRequest $request)
    {
        $validated = $request->validated();

        $teacherlist = new TeacherList;
        $teacherlist->name = $validated['name'];
        $teacherlist->email = $validated['email'];
        $teacherlist->password = Hash::make($validated['password']);
        $teacherlist->department = $validated['department'];
        $teacherlist->role_id = user_role::TEACHER_ID;
        $teacherlist->image = $validated['image']->store('images', 'public');
        $teacherlist->save();

        return redirect('/login')
            ->with('success', 'Signup successful. Teacher can log in now.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeacherList $teacherlist)
    {
        return view('teacher.teacher_profile', ['teacher' => $teacherlist]);
    }

    public function classes(TeacherList $teacherlist): View
    {
        $classes = $teacherlist->classes()
            ->withCount('students')
            ->orderBy('class_name')
            ->get();

        return view('teacher.teacher_classes', compact('teacherlist', 'classes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeacherList $teacherlist)
    {
        return view('teacher.update_teacher_list', [
            'teacherlist' => $teacherlist,
            'profileEdit' => request()->routeIs('teacher.profile.edit'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherFormRequest $request, TeacherList $teacherlist)
    {
        $validated = $request->validated();

        if (! Auth::guard('web')->check()) {
            foreach (['name', 'email', 'department'] as $field) {
                if (! empty($validated[$field])) {
                    $teacherlist->{$field} = $validated[$field];
                }
            }
        }

        if ($validated['password'] ?? false) {
            $teacherlist->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('image')) {
            $teacherlist->image = $validated['image']->store('images', 'public');
        }

        $teacherlist->save();

        if (request()->routeIs('teacher.profile.update')) {
            return redirect()->route('teacher.profile', $teacherlist)
                ->with('success', 'Profile updated successfully.');
        }

        return redirect()->route('teacherlist.index')
            ->with('success', 'Teacher information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeacherList $teacherlist)
    {
        $teacherlist->delete();

        return redirect('/teacherlist');
    }
}
