<?php

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

Route::get('/', function () {
    return "HOME";
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/log', function () {
    return view('log');
});

Route::post('/register-submit',[RegisterController::class,'register']);
Route::get('/admin-accept',[RegisterController::class,'admin_accept']);
Route::get('/delete-register/{id}',[RegisterController::class,'delete_register']);

Route::post('/accept',[UserController::class,'accept']);
Route::get('/users',[UserController::class,'users']);
Route::get('/delete-user/{id}',[UserController::class,'delete_user']);


