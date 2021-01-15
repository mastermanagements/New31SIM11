<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\TawarBeli;
use Session;
use App\Model\Produksi\Supplier;
use App\Model\Produksi\PesananPembelian as PB;
class PesananPembelian extends Controller
{
    public function index(){
        $model = TawarBeli::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        return view('user.produksi.section.belibarang.pesanan_barang.page_create', ['penawaran_pembelian'=> $model,'supplier'=> $supplier]);
    }

    public function store(Request $req){
        $this->validate($req,[
            'no_po' => 'required',
            'tgl_po' => 'required',
            'tgl_po' => 'required',
        ]);
    }
}
