<?php

use Damoon\Blog\Http\Controllers\api\v1\User\Controller as UserBlogController;
use Damoon\Tools\Custom\Route\Route;

Route::controller(UserBlogController::class)->middleware(['api', 'auth:sanctum'])->group(function (){

    Route::prefix('api/v1/blog')->group(function (){

        Route::prefix('{blog:slug}')->group(function (){
            Route::post('like', 'like');
        });
    });

    Route::prefix('api/v1/me/blog')->group(function (){

        Route::post('create', 'create');
        Route::get('/', 'collect');
    });

    Route::prefix('{slug}')->group(function (){
        Route::get('/', 'single');
        Route::put('update', 'update');

        Route::prefix('file')->group(function (){
            Route::post('upload', 'upload');
            Route::delete('{file}/delete', 'removeFile');
        });
    });
});
