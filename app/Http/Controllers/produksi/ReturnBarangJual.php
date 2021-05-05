<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\PSales;
use App\Model\Administrasi\Klien;
use App\Model\Produksi\ReturnBarangJual as RBJ;
use App\Model\Produksi\ComplainBarangJual as CBJ;

class ReturnBarangJual extends Controller
{
    //
    private $jenis_return = [
        'Return Barang',
        'Potong Piutang',
        'Return Uang'
    ];
    public function show($id){
       $model = CBJ::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
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
            'id_complain_barang'=> 'required',
            'jenis_return'=> 'required',
            'tgl_return'=> 'required',
            'ongkos_kirim'=> 'required',
        ]);

        $model= RBJ::updateOrCreate(
            [
                'id_perusahaan'=>Session::get('id_perusahaan_karyawan'),
                'id_complain_barang'=> $req->id_complain_barang,
            ],
            [
                'tgl_return' =>date('Y-m-d', strtotime($req->tgl_return)),
                'jenis_return' =>$req->jenis_return,
                'ongkir_return' =>rupiahController($req->ongkos_kirim),
                'id_karyawan'=>Session::get('id_perusahaan_karyawan')
            ]
        );


        if ($model->save()){
            return redirect()->back()->with('message_success','Data return barang penjualan telah disimpan');
        }else{
            return redirect()->back()->with('message_fail','Data return barang penjualan gagal disimpan');
        }
    }


    public function ubahStatus(Request $req, $id){

  		$model = CBJ::find($id);
      $model->status_return ='1';
      $model->id_karyawan = Session::get('id_perusahaan_karyawan');
      $model->save();
      //dd($model);
  		if($model->save()){
  			  return redirect('Penjualan')->with('message_success',' berhasil ubah status return')->with('tab6','tab6');
  		} else{
  		  return redirect('Penjualan')->with('message_fail','gagal ubah status return')>with('tab6','tab6');
  		}
  	}
}
