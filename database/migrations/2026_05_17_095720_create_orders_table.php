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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // ID người mua (nếu đã đăng nhập)
        $table->foreignId('combo_id')->constrained()->onDelete('cascade'); // Đặt combo nào
        $table->string('customer_name'); // Tên khách hàng nhập vào form
        $table->string('customer_phone'); // Số điện thoại khách
        $table->decimal('total_price', 15, 2); // Tổng tiền đơn hàng
        $table->string('status')->default('pending'); // Trạng thái: pending (chờ duyệt), confirmed (đã duyệt), cancelled (hủy)
        $table->string('payment_status')->default('unpaid'); // Trạng thái thanh toán: unpaid (chưa trả), paid (đã trả)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
