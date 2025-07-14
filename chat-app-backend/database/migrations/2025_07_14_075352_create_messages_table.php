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
        Schema::create('messages', function (Blueprint $table) {
            // Lưu nội dung các tin nhắn người dùng gửi trong các cuộc trò chuyện
            $table->id();
            $table->unsignedBigInteger('conversation_id'); // Thuộc cuộc trò chuyện nào
            $table->unsignedBigInteger('sender_id'); // Ai gửi tin nhắn
            $table->text('content'); // Nội dung tin nhắn
            $table->enum('message_type', ['text', 'image', 'file', 'system'])->default('text');
            $table->timestamps();

            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
