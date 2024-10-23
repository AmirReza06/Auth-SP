<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetPasswordController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/register' , [AuthController::class , 'register'])->name('register');
Route::post('/register' , [AuthController::class , 'registerPost'])->name('register.post');
Route::get('/login' , [AuthController::class , 'login'])->name('login');
Route::post('/login' , [AuthController::class , 'loginPost'])->name('login.post');
Route::get('/logout' , [AuthController::class , 'logout'])->name('logout');
Route::get('/forget-password' , [ForgetPasswordController::class , 'forgetPassword'])->name('forget.password');
Route::post('/forget-password' , [ForgetPasswordController::class , 'forgetPasswordPost'])->name('forget.password.post');
Route::get('/reset-password/{token}' , [ForgetPasswordController::class , 'resetPassword'])->name('reset.password');
Route::post('/reset-password' , [ForgetPasswordController::class , 'resetPasswordUpdate'])->name('reset.password.update');

Route::get('/posts' , [\App\Http\Controllers\PostController::class , 'index'])
    ->name('post.index')
    ->middleware('auth')
;
Route::get('/posts/create' , [\App\Http\Controllers\PostController::class , 'create'])
    ->name('post.create')
    ->middleware('auth')
;
