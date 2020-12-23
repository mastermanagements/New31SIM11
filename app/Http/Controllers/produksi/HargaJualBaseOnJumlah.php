<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use App\Model\Produksi\HargaJualBaseOnJumlah as HjB;
use Session;

class HargaJualBaseOnJumlah extends Controller
{
    //
    public function index($id)
    {
        $data =[
            'data'=> Barang::findOrFail($id)
        ];

        return view('user.produksi.section.barang.harga_jual_base_on_jumlah.page_conten', $data);
    }

    public function create(Request $req){
        $data = [
            'data'=>Barang::findOrFail($req->id_barang),
            'banyak_barang'=> $req->jumlah_barang
        ];
        return view('user.produksi.section.barang.harga_jual_base_on_jumlah.page_create', $data);
    }

    public function store(Request $req){
        $id_barang = $req->id_barang;
        $last_data = HjB::where('id_barang', $id_barang)->orderBy('no_urut','desc')->take(1)->first();

        if(!empty($last_data->no_urut)){
            $i=$last_data->no_urut;
        }else{
            $i = 1;
        }
       foreach ($req->jumlah_maks_brg as $key=> $jumlah_maks_brg){
            $harga_jual = $req->harga_jual[$key];
            $model = HjB::updateOrCreate(
                [
                    'id_barang'=>$id_barang,
                    'no_urut'=>$i++,
                    'id_karyawan'=>Session::get('id_karyawan'),
                    'id_perusahaan'=> Session::get('id_perusahaan_karyawan')
                ],
                [
                    'jumlah_maks_brg'=>$jumlah_maks_brg,
                    'harga_jual'=>$harga_jual
                ]
            );
        }
    }
}
