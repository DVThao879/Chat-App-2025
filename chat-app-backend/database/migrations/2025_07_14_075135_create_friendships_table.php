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
        Schema::create('friendships', function (Blueprint $table) {
            // Lưu mối quan hệ bạn bè giữa hai người dùng (đang chờ, đã chấp nhận, bị chặn...)
            $table->id();
            $table->unsignedBigInteger('user_id'); // Người gửi lời mời
            $table->unsignedBigInteger('friend_id'); // Người nhận
            $table->enum('status', ['pending', 'accepted', 'blocked'])->default('pending');
            $table->timestamps();

            // Ràng buộc khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friendships');
    }
};
