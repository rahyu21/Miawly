<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
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

// Route::get('/', [AuthController::class, 'index'])->name('index');
Route::controller(AuthController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/cek_login', 'cek_login');
    
});
// Route::post('/cek_login', [AuthController::class, 'cek_login']);
// Route::get('/logout', [AuthController::class, 'logout']);

// Route::group(['middleware' => ['auth', 'checkLevel:admin,gudang']], function(){
    //Data Master (user)
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/{id}/update', [UserController::class, 'update']);
    Route::get('/user/{id}/destroy', [UserController::class, 'destroy']);

    //Data Master (kategori)
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::post('/kategori/{id}/update', [KategoriController::class, 'update']);
    Route::get('/kategori/{id}/destroy', [KategoriController::class, 'destroy']);

    //Data Master (barang)
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/store', [BarangController::class, 'store']);
    Route::post('/barang/{id}/update', [BarangController::class, 'update']);
    Route::get('/barang/{id}/destroy', [BarangController::class, 'destroy']);
// });

// Route::group(['middleware' => ['auth','checkLevel:admin,gudang']],function(){
    Route::get('/home', [HomeController::class, 'home']);
// });