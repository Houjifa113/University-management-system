<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherlistController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\studentlistController;
use App\Http\Controllers\ClassController;

//login and logout
Route::controller(LoginController::class)->group(function () {
    Route::view('/login', 'login')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin profile and dashboard pages
Route::prefix('admin')->group(function () {
    Route::middleware(['loginCheck:admin'])->group(function () {
        Route::middleware('can:access-admin-dashboard')->group(function () {
            Route::get('/register', [\App\Http\Controllers\AdminProfileController::class, 'create'])->name('admin.register');
            Route::post('/register', [\App\Http\Controllers\AdminProfileController::class, 'store'])->name('admin.register.store');
            Route::view('/index', 'adminIndex')->name('admin.dashboard');
        });

        Route::middleware('can:edit-own-admin-profile')->group(function () {
        Route::get('/profile', [\App\Http\Controllers\AdminProfileController::class, 'index'])->name('admin.profile');
        Route::get('/profile/edit', [\App\Http\Controllers\AdminProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::put('/profile', [\App\Http\Controllers\AdminProfileController::class, 'update'])->name('admin.profile.update');
        });
    });
});

// Student login.
Route::prefix('student')->group(function () {
    Route::view('/login', 'student.login')->name('student.login');
    Route::post('/login', [LoginController::class, 'studentLogin'])->name('student.login.submit');
    Route::post('/logout', [LoginController::class, 'studentLogout'])->name('student.logout');
});



Route::middleware(['loginCheck:admin', 'can:access-admin-dashboard'])->group(function () {
    Route::view('/signup', 'signup')->name('signup');
    Route::post('/teacherlist', [TeacherlistController::class, 'store'])->name('teacherlist.store');
});

// Class
Route::prefix('class')
    ->name('class.')
    ->middleware(['loginCheck:admin', 'can:manage-classes'])
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




Route::middleware(['loginCheck:web,admin,student'])->group(function () {
Route::view('/form', 'student-form')->middleware('can:isStudent')->name('form');

Route::view('/student-search', 'studentSearch')->middleware('can:isStudent')->name('student.search');
Route::get('/student-search/results', [studentlistController::class, 'search'])->middleware('can:isStudent')->name('student.search.results');

Route::get('/studentlist', [studentlistController::class, 'showStudentlist'])->middleware('can:isStudent')->name('studentlist');

Route::post('/studentlist', [studentlistController::class, 'addStudentlist'])->middleware('can:isStudent')->name('add.studentlist');

Route::post('/studentlist/import', [studentlistController::class, 'import'])->middleware('can:isStudent')->name('studentlist.import');

Route::get('/studentlist/export', [studentlistController::class, 'export'])->middleware('can:isStudent')->name('studentlist.export');

Route::get('/studentlist/{student}/classes', [studentlistController::class, 'classes'])->middleware('can:view-student-profile,student')->name('student.classes');

Route::get('/studentlist/{student}/profile', [studentlistController::class, 'showStudentProfile'])->middleware('can:view-student-profile,student')->name('student.profile');

Route::get('/studentlist/{student}/profile/edit', [studentlistController::class, 'showUpdateStudentlist'])->middleware('can:update-student-profile,student')->name('student.profile.edit');

Route::put('/studentlist/{student}/profile', [studentlistController::class, 'updateStudentlist'])->middleware('can:update-student-profile,student')->name('student.profile.update');

Route::delete('/studentlist/{student}', [studentlistController::class, 'deleteStudentlist'])->middleware('can:isStudent')->name('student.destroy');
});



// Teacher profile pages
Route::middleware(['loginCheck:web,admin'])->group(function () {
    Route::view('/teacher-search', 'teacherSearch')->middleware('can:isTeacher')->name('teacher.search');
    Route::get('/teacher-search/results', [TeacherlistController::class, 'search'])->middleware('can:isTeacher')->name('teacher.search.results');

    Route::resource('/teacherlist', TeacherlistController::class)
         ->only(['index', 'edit', 'update', 'destroy'])
        ->middleware('can:isTeacher');

    Route::get('/teacherlist/{teacherlist}/classes', [TeacherlistController::class, 'classes'])
        ->middleware('can:view-teacher-profile,teacherlist')
        ->name('teacher.classes');

    Route::get('/teacherlist/{teacherlist}', [TeacherlistController::class, 'show'])
        ->middleware('can:view-teacher-profile,teacherlist')
        ->name('teacher.profile');

    Route::get('/teacherlist/{teacherlist}/profile/edit', [TeacherlistController::class, 'edit'])->middleware('can:view-teacher-profile,teacherlist')
        ->name('teacher.profile.edit');

    Route::put('/teacherlist/{teacherlist}/profile', [TeacherlistController::class, 'update'])
        ->middleware('can:view-teacher-profile,teacherlist')
        ->name('teacher.profile.update');
});
