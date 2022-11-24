<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Requests;
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


Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login',[App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
Route::get('/logout',[App\Http\Controllers\Auth\LogoutController::class, 'index'])->name('logout');
Route::post('/login_proses',[App\Http\Controllers\Auth\LoginController::class, 'check'])->name('login_proses');


/*ADMIN*/
Route::get('/admin',[App\Http\Controllers\Auth\AdminController::class, 'index'])->name('admin');
Route::post('/add_user',[App\Http\Controllers\Auth\AdminController::class, 'add_user'])->name('add_user');
Route::post('/delete_user',[App\Http\Controllers\Auth\AdminController::class, 'delete_user'])->name('delete_user');
Route::post('/edit_user',[App\Http\Controllers\Auth\AdminController::class, 'edit_user'])->name('edit_user');



/*USER*/
Route::get('/user',[App\Http\Controllers\Auth\UserController::class, 'index'])->name('user');
Route::post('/edit_users',[App\Http\Controllers\Auth\UserController::class, 'edit_user'])->name('edit_users');

