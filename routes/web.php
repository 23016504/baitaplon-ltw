<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Nhóm các Route dành cho Admin
Route::middleware([])->prefix('admin')->name('admin.')->group(function () {
    
    // Khi gõ đường dẫn http://127.0.0.1:8000/admin -> nhảy thẳng vào trang quản lý dịch vụ
    Route::get('/', [\App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('index');

    // Các lệnh Resource chuẩn CRUD hệ thống
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('combos', \App\Http\Controllers\Admin\ComboController::class);
});

// 2. Các Route mặc định của hệ thống
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. File cấu hình Đăng nhập của Breeze (Đưa xuống cuối cùng)
require __DIR__.'/auth.php';