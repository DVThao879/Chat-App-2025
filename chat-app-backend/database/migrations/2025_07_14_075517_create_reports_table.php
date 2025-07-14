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
        Schema::create('reports', function (Blueprint $table) {
            // Người dùng có thể báo cáo tin nhắn, user, hoặc cuộc trò chuyện
            $table->id();
            $table->unsignedBigInteger('reporter_id'); // Ai báo cáo
            $table->string('reported_type'); // Loại: user / message / conversation
            $table->unsignedBigInteger('reported_id'); // ID của nội dung bị báo
            $table->string('reason')->nullable(); // Lý do
            $table->enum('status', ['pending', 'resolved', 'ignored'])->default('pending');
            $table->text('admin_note')->nullable(); // Ghi chú xử lý
            $table->timestamps();

            $table->foreign('reporter_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
