<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog_views', function (Blueprint $table) {
            $table->string('ip')->nullable()->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('blog_id');
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('blog_id')->references('id')->on('blogs')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique(['user_id', 'blog_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_views');
    }
};
