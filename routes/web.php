<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\UsersController;
use \App\Http\Controllers\VideosController;
use \App\Http\Controllers\AccountController;


Route::get('/', function () {
    return 'PaPet ' . app()->version();
});


Route::middleware('cors')->group(function () {

    Route::controller(UsersController::class)->prefix('users')->group(function () {
        Route::get('/login', 'login');
        Route::get('/register', 'register');
    });

});
