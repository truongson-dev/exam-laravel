<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * Command: php artisan migrate
     */
    public function up(): void
    {
        Schema::create('T_restaurant', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Tên món ăn');
            $table->string('category', 100)->comment('Danh mục: Cơm Dĩa, Bánh mỳ, Bú phở');
            $table->decimal('price', 10, 2)->comment('Giá tiền (VNĐ)');
            $table->text('description')->nullable()->comment('Mô tả món ăn');
            $table->string('image', 255)->nullable()->comment('Đường dẫn ảnh');
            $table->tinyInteger('status')->default(1)->comment('1=Còn hàng, 0=Hết hàng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('T_restaurant');
    }
};