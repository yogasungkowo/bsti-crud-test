<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } else if (Auth::user()->hasRole('student')) {
            return redirect()->route('student.index');
        }
    }
    return redirect()->route('login');
});

Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
        Route::get('register', [App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
    });
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    
    // User Management
    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
        Route::get('/create', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::get('/{user}/edit', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/{user}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/{user}', [App\Http\Controllers\AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    });
    
    // Student Management
    Route::prefix('students')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'students'])->name('admin.students');
        Route::get('/{student}', [App\Http\Controllers\AdminController::class, 'showStudent'])->name('admin.students.show');
        Route::get('/{student}/edit', [App\Http\Controllers\AdminController::class, 'editStudent'])->name('admin.students.edit');
        Route::put('/{student}', [App\Http\Controllers\AdminController::class, 'updateStudent'])->name('admin.students.update');
        Route::delete('/{student}', [App\Http\Controllers\AdminController::class, 'destroyStudent'])->name('admin.students.destroy');
    });
});

Route::prefix('student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
    
    Route::prefix('profile')->group(function () {
        Route::get('/create', [App\Http\Controllers\StudentController::class, 'create'])->name('student.create');
        Route::post('/', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
        Route::get('/{student}/edit', [App\Http\Controllers\StudentController::class, 'edit'])->name('student.edit');
        Route::put('/{student}', [App\Http\Controllers\StudentController::class, 'update'])->name('student.update');
        Route::delete('/{student}', [App\Http\Controllers\StudentController::class, 'destroy'])->name('student.destroy');
    });
});
