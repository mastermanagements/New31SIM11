<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\POrder;
use App\Model\Produksi\ReturnPembelian as return_pembelian;
use Session;
class ReturnPembelian extends Controller
{
    //
    private $data = [
        'Return Barang',
        'Potong Hutang',
        'Return Uang'
    ];


    public function show($id_order){
        $model = POrder::findOrFail($id_order);
        $data = ['data'=> $model,'bentuk_return'=> $this->data];
        return view('user.produksi.section.belibarang.return_pembelian.page_create', $data);
    }

    public function preview($id_order){
        $model = POrder::findOrFail($id_order);
        $data = ['data'=> $model,'bentuk_return'=> $this->data];
        return view('user.produksi.section.belibarang.return_pembelian.page_preview', $data);
    }

    public function store(Request $req){
        $this->validate($req, [
            'id_cek_barang'=> 'required',
            'jenis_return'=> 'required',
            'tgl_return'=> 'required',
            'ongkir_return' => 'required',
        ]);

        $model = return_pembelian::updateOrCreate(
            [
                'id_cek_barang'=> $req->id_cek_barang,
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan')
            ],
            [
                'tgl_return'=> $req->tgl_return,
                'jenis_return'=> $req->jenis_return,
                'ongkir_return'=> $req->ongkir_return,
            ]
        );

        if($model){
            return redirect('Pembelian')->with('message_success','Data return telah disimpan');
        }
    }
}
