<?php

namespace App\Http\Controllers;

use App\Models\adminProfile;
use App\Models\user_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('adminProfile', [
            'adminProfile' => Auth::guard('admin')->user() ?? adminProfile::firstOrFail(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminSignup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255', 'unique:admin,name'],
            'email' => ['required', 'email', 'max:255', 'unique:admin,email'],
            'password' => ['required', 'string', 'min:5', 'max:20', 'confirmed'],
            'department' => ['required', 'string', 'max:255'],
        ]);

        $adminProfile = new adminProfile;
        $adminProfile->name = $validated['name'];
        $adminProfile->email = $validated['email'];
        $adminProfile->password = Hash::make($validated['password']);
        $adminProfile->department = $validated['department'];
        $adminProfile->role_id = user_role::ADMIN_ID;
        $adminProfile->save();

        return redirect()->route('admin.dashboard')
            ->with('success', 'New admin registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(adminProfile $adminProfile) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('updateAdmin', [
            'adminProfile' => Auth::guard('admin')->user() ?? adminProfile::firstOrFail(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $adminProfile = Auth::guard('admin')->user() ?? adminProfile::firstOrFail();

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255', Rule::unique('admin', 'name')->ignore($adminProfile)],
            'email' => ['required', 'email', 'max:255', Rule::unique('admin', 'email')->ignore($adminProfile)],
            'password' => ['nullable', 'string', 'min:5', 'max:20', 'confirmed'],
            'department' => ['required', 'string', 'max:255'],
        ]);

        $adminProfile->name = $validated['name'];
        $adminProfile->email = $validated['email'];
        $adminProfile->department = $validated['department'];

        if ($validated['password'] ?? false) {
            $adminProfile->password = Hash::make($validated['password']);
        }

        $adminProfile->save();

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully.');
    }
}
