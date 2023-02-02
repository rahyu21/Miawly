<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BrgKeluar;
use App\Models\BrgMasuk;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function lap_user()
    {
        $user =User::all();

        return view ('admin.laporan.user.lap_user', compact('user'));
    }
    public function cetak_user()
    {
        $user =User::all();

        return view ('admin.laporan.user.cetak_user', compact('user'));
    }
    public function lap_kategori()
    {
        $kategori =Kategori::all();

        return view ('admin.laporan.kategori.lap_kategori', compact('kategori'));
    }
    public function cetak_kategori()
    {
        $kategori =Kategori::all();

        return view ('admin.laporan.kategori.cetak_kategori', compact('kategori'));
    }
    public function lap_barang()
    {
        $barang = Barang::join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                        ->select('barang.*', 'kategori.nama_kategori')
                        ->get();

        return view ('admin.laporan.barang.lap_barang', compact('barang'));
    }
    public function cetak_barang()
    {
        $barang = Barang::join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                        ->select('barang.*', 'kategori.nama_kategori')
                        ->get();

        return view ('admin.laporan.barang.cetak_barang', compact('barang'));
    }
    public function lap_brg_masuk()
    {
        $brg_masuk = BrgMasuk::join('barang', 'barang.id', '=', 'brg_masuk.id_barang')
                    ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                   ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                   ->get();

        return view ('admin.laporan.brg_masuk.lap_brg_masuk', compact('brg_masuk'));
    }
    public function cetak_brg_masuk(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir= $request->tgl_akhir;

        if ($tgl_awal AND $tgl_akhir) 
        {
            $brg_masuk = BrgMasuk::join('barang', 'barang.id', '=', 'brg_masuk.id_barang')
                                    ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                                    ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                                    ->whereBetween('Brg_Masuk.tgl_brg_masuk', [$tgl_awal,$tgl_akhir])
                                    ->get();
            
            $sum_total = BrgMasuk::whereBetween('tgl_brg_masuk', [$tgl_awal,$tgl_akhir])
                                    ->sum('total');
        }else {
            $brg_masuk = BrgMasuk::join('barang', 'barang.id', '=', 'brg_masuk.id_barang')
            ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
            ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
            ->get();
        }

        return view ('admin.laporan.brg_masuk.cetak_brg_masuk', compact('brg_masuk', 'sum_total', 'tgl_awal', 'tgl_akhir'));
    }
    public function lap_brg_keluar()
    {
        $brg_keluar = Brgkeluar::join('barang', 'barang.id', '=', 'brg_keluar.id_barang')
                    ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                   ->select('brg_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                   ->get();

        return view ('admin.laporan.brg_keluar.lap_brg_keluar', compact('brg_keluar'));
    }
    public function cetak_brg_keluar(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir= $request->tgl_akhir;

        if ($tgl_awal AND $tgl_akhir) 
        {
            $brg_keluar = Brgkeluar::join('barang', 'barang.id', '=', 'brg_keluar.id_barang')
                                    ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                                    ->select('brg_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                                    ->whereBetween('Brg_keluar.tgl_brg_keluar', [$tgl_awal,$tgl_akhir])
                                    ->get();
            
            $sum_total = BrgKeluar::whereBetween('tgl_brg_keluar', [$tgl_awal,$tgl_akhir])
                                    ->sum('total');
        }else {
            $brg_keluar = BrgKeluar::join('barang', 'barang.id', '=', 'brg_keluar.id_barang')
                                    ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                                    ->select('brg_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                                    ->get();
        }

        return view ('admin.laporan.brg_keluar.cetak_brg_keluar', compact('brg_keluar', 'sum_total', 'tgl_awal', 'tgl_akhir'));
    }
    
}
