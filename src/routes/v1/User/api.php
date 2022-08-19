<?php

use Damoon\Blog\Http\Controllers\api\v1\User\Controller as UserBlogController;
use Damoon\Tools\Custom\Route\Route;

Route::prefix('api/v1/blog')->middleware(['api', 'auth:sanctum'])->controller(UserBlogController::class)->group(function (){

    Route::prefix('{blog:slug}')->group(function (){
        Route::post('like', 'like');
    });
});
