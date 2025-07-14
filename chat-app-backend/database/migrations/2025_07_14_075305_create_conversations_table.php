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
        Schema::create('conversations', function (Blueprint $table) {
            // Lưu thông tin cuộc trò chuyện (1-1 hoặc nhóm)
            $table->id();
            $table->boolean('is_group')->default(false); // false = chat 1-1, true = group
            $table->string('name')->nullable(); // Tên nhóm (nếu là group)
            $table->unsignedBigInteger('created_by')->nullable(); // Ai tạo cuộc trò chuyện
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
