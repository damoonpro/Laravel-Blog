<?php

use Damoon\Blog\Http\Controllers\api\v1\Admin\Category\Controller as AdminCategoryController;
use Damoon\Blog\Http\Controllers\api\v1\AdminController;
use Damoon\Tools\Custom\Route\Route;

Route::prefix('api/v1/admin/blog')->middleware(['api', 'auth:sanctum'])->group(function (){

    Route::controller(AdminController::class)->group(function (){
        Route::get('/', 'collect');
    });

    Route::prefix('category')->controller(AdminCategoryController::class)->group(function (){
        Route::get('/', 'collect');

        Route::prefix('{category}')->group(function (){
            Route::put('update', 'update');
        });
    });
});
