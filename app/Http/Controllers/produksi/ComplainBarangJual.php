<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\ComplainBarangJual as CBJ;
use Session;

class ComplainBarangJual extends Controller
{
    //

    public function store(Request $req){
      //dd($req->all());
        $this->validate($req,[
          "id_sales" => "required",
         "id_detail_sales" => "required",
          "id_barang" => "required",
          "hpp" => "required",
          "jumlah_beli" => "required",
          "diskon_item" => "required",
          "jumlah_harga" => "required",
          "status_complain" => "required",
        ]);
        #cek jumlah brg kurang dan rusak
        $brg_kurang = $req->complain_jumlah;
        $brg_rusak = $req->complain_kualitas;
        if($brg_kurang ==NULL){
          $brg_kurang =0;
        }
        if($brg_rusak ==NULL){
          $brg_rusak =0;
        }

        if($req->complain_jumlah)
        #cek barang jika jumlah barang lebih kecil dari barang complain
        if($req->jumlah_beli < $req->complain_jumlah){
            return redirect()->back()->with('message_fail','Jumlah complain lebih dari jumlah beli');
        }

        $jum_brg_kurang = $brg_kurang * rupiahController($req->hpp);
        $jum_brg_rusak = $brg_rusak * rupiahController($req->hpp);

        $total_return = $jum_brg_kurang + $jum_brg_rusak;

        $model = CBJ::updateOrCreate(
            [
                'id_detail_sales'=> $req->id_detail_sales,
                'id_sales'=> $req->id_sales,
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
            ],
            [
                'id_barang'=> $req->id_barang,
                'hpp'=> rupiahController($req->hpp),
                'jumlah_beli'=> rupiahController($req->jumlah_beli),
                'diskon_item'=> $req->diskon_item,
                'complain_jumlah'=> $brg_kurang,
                'complain_kualitas'=> $brg_rusak,
                'total_return'=>$total_return,
                'ket'=> $req->ket,
                'status_complain'=> $req->status_complain,
                'alasan_ditolak'=> $req->alasan_ditolak,
                'id_karyawan'=>Session::get('id_karyawan'),
            ]
        );
        //dd($model->all());
        if($model->save()){
            return redirect()->back()->with('message_success', 'Data complain telah tersimpan');
        }else{
            return redirect()->back()->with('message_fail', 'Data complain gagal tersimpan');
        }
    }
}
