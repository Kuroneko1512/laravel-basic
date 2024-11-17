<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop-detail/{id}', [HomeController::class, 'detail'])->name('detail');
Route::get('/shop-list', [HomeController::class, 'list'])->name('list');
Route::get('/shop-list/sort', [HomeController::class, 'list'])->name('shop.sort');
Route::get('/search', [HomeController::class, 'search'])->name('search.product');

Route::get('/login', [AuthenticateController::class, 'loginForm'])->name('login');
Route::get('/register', [AuthenticateController::class, 'registerForm'])->name('register'); 
Route::post('/login', [AuthenticateController::class, 'login'])->name('login.post');
Route::post('/register', [AuthenticateController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthenticateController::class, 'logout'])->name('logout');