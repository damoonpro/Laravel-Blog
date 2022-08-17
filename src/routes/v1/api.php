<?php

use Damoon\Blog\Http\Controllers\api\v1\Controller as BlogController;
use Damoon\Tools\Custom\Route\Route;

Route::prefix('api/v1/blog')
    ->middleware('api')
    ->controller(BlogController::class)
    ->group(function (){

    Route::get('/', 'collect');
    Route::get('{blog:slug}', 'single');
});
