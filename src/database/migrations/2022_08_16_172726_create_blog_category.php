<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog_category', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('blog_id')->references('id')->on('blogs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('category_id')->references('id')->on('blog_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['blog_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_category');
    }
};
