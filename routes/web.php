<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::get('/register',[RegisterController::class, 'index']) ->name('Register');
Route::post('/register',[RegisterController::class, 'store']);

Route::get('/login',[LoginController::class, 'index']) ->name('login');
Route::post('/login',[LoginController::class, 'store']);

Route::post('/logout',[LogoutController::class, 'store']) ->name('logout');

Route::get('/',function (){
    return view('home');
}) ->name('home');

Route::get('/posts',[PostController::class, 'index']) ->name('posts');
Route::post('/posts',[PostController::class, 'store']);

Route::post('/posts/{post}/likes',[PostLikeController::class, 'store']) ->name('posts.like');
Route::delete('/posts/{post}/likes',[PostLikeController::class, 'destroy']) ->name('posts.like');
