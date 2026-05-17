<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('combos', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Tên gói combo (Ví dụ: Combo Đà Nẵng 3N2Đ)
        $table->text('description'); // Mô tả chi tiết combo
        $table->string('image')->nullable(); // Ảnh đại diện của combo
        $table->boolean('is_featured')->default(0); // 1: Combo nổi bật, 0: Bình thường (Ăn điểm cộng)
        $table->timestamps(); // Tự động tạo 2 cột created_at và updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combos');
    }
};
