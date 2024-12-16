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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('title');
            $table->text('content');
            $table->boolean('display')->default(true);
            $table->boolean('new')->default(true);
            $table->string('image');
            $table->string('keyword_focus');
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->unsignedBigInteger('menu_id'); // Thêm cột khóa ngoại
            $table->foreign('menu_id')->references('id')->on('menu_news')->onDelete('cascade');
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
        Schema::dropIfExists('news');
    }
};
