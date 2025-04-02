<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/{id?}', [App\Http\Controllers\HomeController::class, 'info']);
Route::group(['prefix' => "admin",'middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'profile']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

    Route::resource('link', \App\Http\Controllers\LinkController::class);
    Route::resource('student', \App\Http\Controllers\StudentController::class);
    Route::resource('record', \App\Http\Controllers\RecordController::class);


    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    Route::resource('user', \App\Http\Controllers\UserController::class);

});
