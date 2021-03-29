<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\PSales;
use App\Model\Administrasi\Klien;
use App\Model\Produksi\ReturnBarangJual as RBJ;

class ReturnBarangJual extends Controller
{
    //
    private $jenis_return = [
        'Return Barang',
        'Potong Piutang',
        'Return Uang'
    ];
    public function show($id){
       $model = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $data = [
          'data'=> $model,
          'klien'=>Klien::all()->where('id_perusahaan',  Session::get('id_perusahaan_karyawan')),
          'jenis_return'=> $this->jenis_return
        ];
        return view('user.produksi.section.jualbarang.return.page_barang_return',$data);
    }

    public function cetak($id){
        $model = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $data = [
            'data'=> $model,
            'klien'=>Klien::all()->where('id_perusahaan',  Session::get('id_perusahaan_karyawan')),
            'jenis_return'=> $this->jenis_return
        ];
        return view('user.produksi.section.jualbarang.return.cetak_return_penjualan',$data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'id_sales'=> 'required',
            'no_order'=> 'required',
            'tgl_sales'=> 'required',
            'id_metode_return'=> 'required',
            'tgl_return'=> 'required',
            'ongkos_kirim'=> 'required',
        ]);

        $model= RBJ::updateOrCreate(
            [
                'id_perusahaan'=>Session::get('id_perusahaan_karyawan'),
                'id_complain_barang'=> $req->id_sales,
            ],
            [
                'tgl_return' =>date('Y-m-d', strtotime($req->tgl_return)),
                'jenis_return' =>$req->id_metode_return,
                'ongkir_return' =>$req->ongkos_kirim,
            ]
        );

        if ($model->save()){
            return redirect()->back()->with('message_success','Data return barang penjualan telah disimpan');
        }else{
            return redirect()->back()->with('message_fail','Data return barang penjualan gagal disimpan');
        }
    }
}
