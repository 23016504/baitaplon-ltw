<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;

    // Cho phép hệ thống lưu các trường dữ liệu này vào database khi chạy lệnh CRUD
    protected $fillable = ['title', 'description', 'image', 'is_featured'];

    // Thiết lập quan hệ Nhiều-Nhiều với bảng Services thông qua bảng trung gian combo_service
    public function services()
    {
        return $this->belongsToMany(Service::class, 'combo_service');
    }

    // Tự động tính tổng tiền Combo bằng cách cộng dồn giá của các dịch vụ thành phần
    public function getTotalPriceAttribute()
    {
        return $this->services->sum('price');
    }
}