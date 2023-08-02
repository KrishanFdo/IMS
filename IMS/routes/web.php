<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('register');
})->middleware('guest');

Route::get('/login', function () {
    return view('log');
})->middleware('guest');

Route::post('/register-submit',[RegisterController::class,'register']);
Route::get('/admin-accept',[RegisterController::class,'admin_accept']);
Route::delete('/delete-register',[RegisterController::class,'delete_register']);

Route::post('/accept',[UserController::class,'accept']);
Route::get('/users',[UserController::class,'users']);
Route::delete('/delete-user',[UserController::class,'delete_user']);

Route::post('/authenticate',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);


