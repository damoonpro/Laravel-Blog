<?php

use Damoon\Blog\Http\Controllers\api\v1\UserController;
use Damoon\Tools\Custom\Route\Route;

Route::prefix('api/v1/me/blog')->controller(UserController::class)->middleware(['api', 'auth:sanctum'])->group(function (){

    Route::post('create', 'create');
});
