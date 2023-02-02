<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BrgMasuk;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class BrgMasukController extends Controller
{
    public function index()
    {
        $brg_masuk = BrgMasuk::join('barang', 'barang.id', '=', 'brg_masuk.id_barang')
                    ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                   ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                   ->get();
        $barang =Barang::all();

        return view ('gudang.transaksi.brg_masuk.brg_masuk', compact('barang', 'brg_masuk'));
    }

    public function create()
    {
        $barang =Barang::all();

        $q = DB::table('brg_masuk')->select(DB::raw('MAX(RIGHT(no_brg_masuk,3)) as kode'));
        $kd="";
        if ($q->count()>0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode)+1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        
        return view('gudang.transaksi.brg_masuk.add', compact('barang', 'kd'));
    }

    public function ajax(Request $request)
    {
        $id_barang['id_barang'] = $request->id_barang;
        $ajax_barang = Barang::where('id', $id_barang)->get();
     
        return view('gudang.transaksi.brg_masuk.ajax', compact('ajax_barang'));
    }
    public function store(Request $request)
    {
        BrgMasuk::create([
            'no_brg_masuk' => $request->no_brg_masuk,
            'id_barang' => $request->id_barang,
            'id_user' => $request->id_user,
            'tgl_brg_masuk' => $request->tgl_brg_masuk,
            'jml_brg_masuk' => $request->jml_brg_masuk,
            'total' => $request->total,
            'created_at' => $request->created_at,
            'updated_at' =>$request->updated_at,
        ]);

        $barang = Barang::find($request->id_barang);
        $barang->stok += $request->jml_brg_masuk;
        $barang->save();

        return redirect('/brg_masuk')->with('success', 'Data Berhasil Disimpan');
    }
}
