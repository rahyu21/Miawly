<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BrgKeluarController;
use App\Http\Controllers\BrgMasukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
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
// Route::controller(AuthController::class)->group(function(){
//     Route::get('/', 'index')->name('index');
//     Route::post('/cek_login', 'cek_login');
    
// });
Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('/cek_login', [AuthController::class, 'cek_login'])->name('cek_login');
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth', 'checkLevel:admin']], function(){
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

    //Data Laporan
    Route::get('/lap_brg_masuk', [LaporanController::class, 'lap_brg_masuk']);
    Route::get('/lap_brg_masuk/cetak_brg_masuk', [LaporanController::class, 'cetak_brg_masuk']);

    Route::get('/lap_brg_keluar', [LaporanController::class, 'lap_brg_keluar']);
    Route::get('/lap_brg_keluar/cetak_brg_keluar', [LaporanController::class, 'cetak_brg_keluar']);

    Route::post('/lap_user', [LaporanController::class, 'lap_user']);
    Route::post('/lap_user/cetak_user', [LaporanController::class, 'cetak_user']);
    
    Route::get('/lap_barang', [LaporanController::class, 'lap_barang']);
    Route::get('/lap_barang/cetak_barang', [LaporanController::class, 'cetak_barang']);

    Route::get('/lap_kategori', [LaporanController::class, 'lap_kategori']);
    Route::get('/lap_kategori/cetak_kategori', [LaporanController::class, 'cetak_kategori']);
});

Route::group(['middleware' => ['auth','checkLevel:gudang']],function(){
    Route::get('/home', [HomeController::class, 'home']);

    //Data Transaksi (Barang Masuk)
    Route::get('/brg_masuk', [BrgMasukController::class, 'index']);
    Route::get('/brg_masuk/ajax', [BrgMasukController::class, 'ajax']);
    Route::get('/brg_masuk/create', [BrgMasukController::class, 'create']);
    Route::post('/brg_masuk/store', [BrgMasukController::class, 'store']);

    //Data Transaksi (Barang Keluar)
    Route::get('/brg_keluar', [BrgKeluarController::class, 'index']);
    Route::get('/brg_masuk/ajax', [BrgKeluarController::class, 'ajax']);
    Route::get('/brg_keluar/create', [BrgKeluarController::class, 'create']);
    Route::post('/brg_keluar/store', [BrgKeluarController::class, 'store']);
});