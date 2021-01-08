<?php

namespace App\Http\Controllers\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use Session;
class StokOpname extends Controller
{
    //
    public function index(){
        $data = [
            'menu'=>'stok_opname',
            'data_barang'=> Barang::all()->where('id_perusahaan_karyawan', Session::get('id_perusahaan'))
        ];
        return view('user.produksi.section.inventory.page_default', $data);
    }

    public function cetak(){
        $data = [
            'menu'=>'stok_opname',
            'data_barang'=> Barang::all()->where('id_perusahaan_karyawan', Session::get('id_perusahaan'))
        ];
        return view('user.produksi.section.inventory.stok_opname.print_stok_opname', $data);
    }
}
