<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->decimal('price', 8, 2);
            $table->decimal('pro-price', 8, 2)->default(true);
            $table->string('stock')->default(true);
            $table->boolean('display')->default(true);
            $table->boolean('new')->default(true);
            $table->boolean('discount')->default(true);
            $table->unsignedBigInteger('menu_id'); // Thêm cột khóa ngoại
            $table->string('keyword_focus');
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->json('images')->nullable(); // thêm cột JSON
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
