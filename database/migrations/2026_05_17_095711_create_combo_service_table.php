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
    Schema::create('combo_service', function (Blueprint $table) {
        $table->id();
        // Khóa ngoại nối sang bảng combos, nếu combo bị xóa thì hàng này tự xóa theo
        $table->foreignId('combo_id')->constrained()->onDelete('cascade'); 
        // Khóa ngoại nối sang bảng services
        $table->foreignId('service_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combo_service');
    }
};
