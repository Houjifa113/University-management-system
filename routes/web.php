<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentListController;
use App\Http\Controllers\TeacherListController;
use Illuminate\Support\Facades\Route;

// login and logout
Route::controller(LoginController::class)->group(function () {
    Route::view('/login', 'login')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin profile and dashboard pages
Route::prefix('admin')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::middleware('can:access-admin-dashboard')->group(function () {
            Route::get('/register', [AdminController::class, 'create'])->name('admin.register');
            Route::post('/register', [AdminController::class, 'store'])->name('admin.register.store');
            Route::view('/index', 'admin.admin_index')->name('admin.dashboard');
        });

        Route::middleware('can:edit-own-admin-profile')->group(function () {
            Route::get('/profile', [AdminController::class, 'index'])->name('admin.profile');
            Route::get('/profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit');
            Route::put('/profile', [AdminController::class, 'update'])->name('admin.profile.update');
        });
    });
});

// Redirect to login
Route::redirect('/student/login', '/login')->name('student.login');

Route::middleware(['auth:sanctum', 'can:access-admin-dashboard'])->group(function () {
    Route::view('/signup', 'teacher.create_teacher')->name('signup');
    Route::post('/teacherlist', [TeacherListController::class, 'store'])->name('teacherlist.store');
});

// Class
Route::prefix('class')
    ->name('class.')
    ->middleware(['auth:sanctum', 'can:manage-classes'])
    ->controller(ClassController::class)
    ->group(function () {
        Route::get('/list', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/details/{classlist}', 'show')->name('show');
        Route::get('/assign-teacher', 'assignTeacher')->name('teacher.assign');
        Route::post('/assign-teacher/{teacher}', 'storeTeacherAssignment')->name('teacher.store');
        Route::get('/assign-student', 'assignStudent')->name('student.assign');
        Route::post('/assign-student', 'storeStudentAssignment')->name('student.store');
    });

Route::middleware(['auth:sanctum'])->group(function () {
    Route::view('/form', 'student.create_student')->middleware('can:isStudent')->name('form');

    Route::view('/student-search', 'student.student_search')->middleware('can:isStudent')->name('student.search');
    Route::get('/student-search/results', [StudentListController::class, 'search'])->middleware('can:isStudent')->name('student.search.results');

    Route::get('/studentlist', [StudentListController::class, 'index'])->middleware('can:isStudent')->name('studentlist');

    Route::post('/studentlist', [StudentListController::class, 'store'])->middleware('can:isStudent')->name('add.studentlist');

    Route::post('/studentlist/import', [StudentListController::class, 'import'])->middleware('can:isStudent')->name('studentlist.import');

    Route::get('/studentlist/export', [StudentListController::class, 'export'])->middleware('can:isStudent')->name('studentlist.export');

    Route::get('/studentlist/{student}/classes', [StudentListController::class, 'classes'])->middleware('can:view-student-profile,student')->name('student.classes');

    Route::get('/studentlist/{student}/profile', [StudentListController::class, 'show'])->middleware('can:view-student-profile,student')->name('student.profile');

    Route::get('/studentlist/{student}/profile/edit', [StudentListController::class, 'edit'])->middleware('can:update-student-profile,student')->name('student.profile.edit');

    Route::put('/studentlist/{student}/profile', [StudentListController::class, 'update'])->middleware('can:update-student-profile,student')->name('student.profile.update');

    Route::delete('/studentlist/{student}', [StudentListController::class, 'destroy'])->middleware('can:isStudent')->name('student.destroy');
});

// Teacher profile pages
Route::middleware(['auth:sanctum'])->group(function () {
    Route::view('/teacher-search', 'teacher.teacher_search')->middleware('can:isTeacher')->name('teacher.search');
    Route::get('/teacher-search/results', [TeacherListController::class, 'search'])->middleware('can:isTeacher')->name('teacher.search.results');

    Route::resource('/teacherlist', TeacherListController::class)
        ->only(['index', 'edit', 'update', 'destroy'])
        ->middleware('can:isTeacher');

    Route::get('/teacherlist/{teacherlist}/classes', [TeacherListController::class, 'classes'])
        ->middleware('can:view-teacher-profile,teacherlist')
        ->name('teacher.classes');

    Route::get('/teacherlist/{teacherlist}', [TeacherListController::class, 'show'])
        ->middleware('can:view-teacher-profile,teacherlist')
        ->name('teacher.profile');

    Route::get('/teacherlist/{teacherlist}/profile/edit', [TeacherListController::class, 'edit'])->middleware('can:view-teacher-profile,teacherlist')
        ->name('teacher.profile.edit');

    Route::put('/teacherlist/{teacherlist}/profile', [TeacherListController::class, 'update'])
        ->middleware('can:view-teacher-profile,teacherlist')
        ->name('teacher.profile.update');
});
