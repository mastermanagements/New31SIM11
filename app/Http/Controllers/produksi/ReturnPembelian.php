<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\POrder;
use App\Model\Produksi\Detail_Cek_Barang as dcb;
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
      //  $model = dcb::findorFail($id_order);
        $data = ['data'=> $model,'bentuk_return'=> $this->data];

        //dd($model);
        return view('user.produksi.section.belibarang.return_pembelian.page_create', $data);
    }

    public function preview($id_order){
        $model = POrder::findOrFail($id_order);
        $data = ['data'=> $model,'bentuk_return'=> $this->data];
        return view('user.produksi.section.belibarang.return_pembelian.page_preview', $data);
    }

    public function store(Request $req){
      //dd($req->all());
        $this->validate($req, [
            'id_order'=> 'required',
            'jenis_return'=> 'required',
            'tgl_return'=> 'required',
            'ongkir_return' => 'required',
        ]);

        $model = return_pembelian::updateOrCreate(
            [
                'id_order'=> $req->id_order,
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan')
            ],
            [
                'tgl_return'=> tanggalController($req->tgl_return),
                'jenis_return'=> $req->jenis_return,
                'ongkir_return'=> rupiahController($req->ongkir_return),
                'id_karyawan'=> Session::get('id_karyawan')
            ]
        );

        if($model){
            return redirect('Pembelian')->with('message_success','Data return telah disimpan')->with('tab5','tab5');
        }
    }
}
