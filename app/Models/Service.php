<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Cho phép hệ thống lưu các trường dữ liệu này vào database khi chạy lệnh CRUD
    protected $fillable = ['name', 'type', 'price'];

    // Thiết lập quan hệ Nhiều-Nhiều ngược lại với Combo (nếu sau này cần dùng)
    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'combo_service');
    }
}