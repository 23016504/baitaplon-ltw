<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// =========================================================================
// GIAI ĐOẠN 3: Hàng rào mở toang để test CRUD không lo bị lỗi 404 phân quyền
// =========================================================================
Route::prefix('admin')->name('admin.')->group(function () {
    // Khi gõ đường dẫn http://127.0.0.1:8000/admin -> Nhảy thẳng vào trang dịch vụ
    Route::get('/', [\App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('index');
    
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('combos', \App\Http\Controllers\Admin\ComboController::class);
});


// =========================================================================
// CÁC ROUTE MẶC ĐỊNH CỦA HỆ THỐNG (Giữ lại để không bị lỗi hệ thống)
// =========================================================================

// Trang chủ hiển thị giao diện welcome mặc định
Route::get('/', function () {
    return view('welcome');
});

// Trang Dashboard sau khi đăng nhập thành công
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Các Route chỉnh sửa thông tin cá nhân (Profile)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =========================================================================
// FILE CẤU HÌNH ĐĂNG NHẬP CỦA BREEZE (Luôn đưa xuống cuối cùng)
// =========================================================================
require __DIR__.'/auth.php';