<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware('user.or.admin')->group(function () {
    // Data
    Route::get('/dashboard', [DataController::class, 'index'])->name('dashboard');
    Route::get('/register', [DataController::class, 'create'])->name('register');
    Route::post('/data', [DataController::class, 'store'])->name('data.store');
    Route::get('/edit/{data}', [DataController::class, 'edit'])->name('data.edit');
    Route::put('/edit/{data}', [DataController::class, 'update'])->name('data.update');
    Route::delete('/data/{data}', [DataController::class, 'destroy'])->name('data.destroy');

    // Inquiry
    Route::get('/inquiry', [InquiryController::class, 'create'])->name('inquiry');
    Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

    // User Management (Admin Only)
    Route::middleware('admin.only')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/register', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/register', [UserController::class, 'store'])->name('user.store');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });
});
