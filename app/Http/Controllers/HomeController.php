<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BrgKeluar;
use App\Models\BrgMasuk;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $user = User::count();
        $barang = Barang::count();
        $kategori = Kategori::count();

        $date = date('y-m-d');
        $brg_masuk_today = BrgMasuk::where('tgl_brg_masuk', '=', $date)->count();
        $brg_keluar_today = BrgKeluar::where('tgl_brg_keluar', '=', $date)->count();

        $brg_masuk = BrgMasuk::count();
        $brg_keluar = BrgKeluar::count();

        $masuk_jan = BrgMasuk::whereMonth('tgl_brg_masuk', '01')->count();
        $masuk_feb = BrgMasuk::whereMonth('tgl_brg_masuk', '02')->count();
        $masuk_mar = BrgMasuk::whereMonth('tgl_brg_masuk', '03')->count();
        $masuk_apr = BrgMasuk::whereMonth('tgl_brg_masuk', '04')->count();
        $masuk_mei = BrgMasuk::whereMonth('tgl_brg_masuk', '05')->count();
        $masuk_jun = BrgMasuk::whereMonth('tgl_brg_masuk', '06')->count();
        $masuk_jul = BrgMasuk::whereMonth('tgl_brg_masuk', '07')->count();
        $masuk_agt = BrgMasuk::whereMonth('tgl_brg_masuk', '08')->count();
        $masuk_sep = BrgMasuk::whereMonth('tgl_brg_masuk', '09')->count();
        $masuk_okt = BrgMasuk::whereMonth('tgl_brg_masuk', '10')->count();
        $masuk_nov = BrgMasuk::whereMonth('tgl_brg_masuk', '11')->count();
        $masuk_des = BrgMasuk::whereMonth('tgl_brg_masuk', '12')->count();

        $keluar_jan = BrgKeluar::whereMonth('tgl_brg_keluar', '01')->count();
        $keluar_feb = BrgKeluar::whereMonth('tgl_brg_keluar', '02')->count();
        $keluar_mar = BrgKeluar::whereMonth('tgl_brg_keluar', '03')->count();
        $keluar_apr = BrgKeluar::whereMonth('tgl_brg_keluar', '04')->count();
        $keluar_mei = BrgKeluar::whereMonth('tgl_brg_keluar', '05')->count();
        $keluar_jun = BrgKeluar::whereMonth('tgl_brg_keluar', '06')->count();
        $keluar_jul = BrgKeluar::whereMonth('tgl_brg_keluar', '07')->count();
        $keluar_agt = BrgKeluar::whereMonth('tgl_brg_keluar', '08')->count();
        $keluar_sep = BrgKeluar::whereMonth('tgl_brg_keluar', '09')->count();
        $keluar_okt = BrgKeluar::whereMonth('tgl_brg_keluar', '10')->count();
        $keluar_nov = BrgKeluar::whereMonth('tgl_brg_keluar', '11')->count();
        $keluar_des = BrgKeluar::whereMonth('tgl_brg_keluar', '12')->count();

        return view('home', 
                compact('user',
                        'barang',
                        'kategori',
                        'brg_masuk_today',
                        'brg_keluar_today',
                        'brg_masuk',
                        'brg_keluar',
                        'masuk_jan', 'masuk_feb', 'masuk_mar', 'masuk_apr',
                        'masuk_mei', 'masuk_jun', 'masuk_jul', 'masuk_agt',
                        'masuk_sep', 'masuk_okt', 'masuk_nov', 'masuk_des',
                        'keluar_jan', 'keluar_feb', 'keluar_mar', 'keluar_apr',
                        'keluar_mei', 'keluar_jun', 'keluar_jul', 'keluar_agt',
                        'keluar_sep', 'keluar_okt', 'keluar_nov', 'keluar_des'
                    ));
    }
}
