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
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements("id"); //UNSIGNED BIGINT
            $table->unsignedBigInteger('mf_id');
            $table->foreign('mf_id')->references('id')->on('mfs')->onDelete('cascade')->onUpdate('cascade');
            $table->string('model');
            $table->date('produced_on');
            $table->string('image')->nullable(); // Thêm cột hình ảnh
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
