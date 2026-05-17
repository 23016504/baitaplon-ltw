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
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Tên dịch vụ (Ví dụ: Khách sạn Mường Thanh, Vé Bà Nà Hills)
        $table->string('type'); // Loại dịch vụ: tour, hotel, transport, sightseeing
        $table->decimal('price', 15, 2); // Giá tiền của riêng dịch vụ đó
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
