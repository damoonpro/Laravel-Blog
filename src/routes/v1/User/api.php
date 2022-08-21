<?php

use Damoon\Blog\Http\Controllers\api\v1\User\Controller as UserBlogController;
use Damoon\Blog\Http\Controllers\api\v1\UserController;
use Damoon\Tools\Custom\Route\Route;

Route::prefix('api/v1/blog')->middleware(['api', 'auth:sanctum'])->controller(UserBlogController::class)->group(function (){

    Route::prefix('{blog:slug}')->group(function (){
        Route::post('like', 'like');
    });
});

Route::prefix('api/v1/me/blog')->controller(UserController::class)->middleware(['api', 'auth:sanctum'])->group(function (){

    Route::post('create', 'create');

    Route::prefix('{slug}')->group(function (){
        Route::get('/', 'single');
        Route::put('update', 'update');
        Route::post('upload', 'upload');
    });
});
