<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('like_blog', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('blog_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('blog_id')->references('id')->on('blogs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('like_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('like_blogs');
    }
};
