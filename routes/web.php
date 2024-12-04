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


//Auth::routes();

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index']);
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');
Route::get('/login',[App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
Route::get('/logout',[App\Http\Controllers\Auth\LogoutController::class, 'index'])->name('logout');
Route::post('/login_proses',[App\Http\Controllers\Auth\LoginController::class, 'check'])->name('login_proses');
Route::post('/register_proses',[App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register_proses');


Route::get('/home',[App\Http\Controllers\Auth\GuestController::class, 'index'])->name('home');
Route::get('/api_artikel',[App\Http\Controllers\Auth\GuestController::class, 'api_artikel'])->name('api_artikel');
Route::get('/about',[App\Http\Controllers\Auth\GuestController::class, 'about'])->name('about');
Route::get('/team',[App\Http\Controllers\Auth\GuestController::class, 'team'])->name('team');
Route::get('/artikel',[App\Http\Controllers\Auth\GuestController::class, 'artikel'])->name('artikel');
Route::get('/contact_us',[App\Http\Controllers\Auth\GuestController::class, 'contact_us'])->name('contact_us');
Route::get('/service',[App\Http\Controllers\Auth\GuestController::class, 'service'])->name('service');
Route::get('/history',[App\Http\Controllers\Auth\GuestController::class, 'history'])->name('history');
Route::post('/add_service',[App\Http\Controllers\Auth\GuestController::class, 'add_service'])->name('add_service');


/*ADMIN*/
Route::get('/admin',[App\Http\Controllers\Auth\AdminController::class, 'index'])->name('admin');

Route::get('/admin_layanan',[App\Http\Controllers\Auth\AdminController::class, 'admin_layanan'])->name('admin_layanan');
Route::post('/add_layanan',[App\Http\Controllers\Auth\AdminController::class, 'add_layanan'])->name('add_layanan');
Route::post('/delete_layanan',[App\Http\Controllers\Auth\AdminController::class, 'delete_layanan'])->name('delete_layanan');
Route::post('/edit_layanan',[App\Http\Controllers\Auth\AdminController::class, 'edit_layanan'])->name('edit_layanan');

Route::get('/admin_promo',[App\Http\Controllers\Auth\AdminController::class, 'admin_promo'])->name('admin_promo');
Route::post('/add_promo',[App\Http\Controllers\Auth\AdminController::class, 'add_promo'])->name('add_promo');
Route::post('/delete_promo',[App\Http\Controllers\Auth\AdminController::class, 'delete_promo'])->name('delete_promo');
Route::post('/edit_promo',[App\Http\Controllers\Auth\AdminController::class, 'edit_promo'])->name('edit_promo');

Route::get('/admin_user',[App\Http\Controllers\Auth\AdminController::class, 'admin_user'])->name('admin_user');
Route::post('/add_user',[App\Http\Controllers\Auth\AdminController::class, 'add_user'])->name('add_user');
Route::post('/delete_user',[App\Http\Controllers\Auth\AdminController::class, 'delete_user'])->name('delete_user');
Route::post('/edit_user',[App\Http\Controllers\Auth\AdminController::class, 'edit_user'])->name('edit_user');

Route::get('/admin_transaksi',[App\Http\Controllers\Auth\AdminController::class, 'admin_transaksi'])->name('admin_transaksi');
Route::post('/delete_transaksi',[App\Http\Controllers\Auth\AdminController::class, 'delete_transaksi'])->name('delete_transaksi');
Route::post('/edit_transaksi',[App\Http\Controllers\Auth\AdminController::class, 'edit_transaksi'])->name('edit_transaksi');



Route::get('/user',[App\Http\Controllers\Auth\AdminController::class, 'user_pemesanan'])->name('user');

Route::get('/user_pemesanan',[App\Http\Controllers\Auth\AdminController::class, 'user_pemesanan'])->name('user_pemesanan');
Route::post('/add_pemesanan',[App\Http\Controllers\Auth\AdminController::class, 'add_pemesanan'])->name('add_pemesanan');

Route::get('/user_history',[App\Http\Controllers\Auth\AdminController::class, 'user_history'])->name('user_history');





