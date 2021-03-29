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
        $this->validate($req,[
         "id_detail_sales" => "required",
          "id_sales" => "required",
          "id_barang" => "required",
          "hpp" => "required",
          "jumlah_beli" => "required",
          "diskon_item" => "required",
          "jumlah_harga" => "required",
          "complain_jumlah" => "required",
          "complain_kualitas" => "required",
          "status_complain" => "required",
          "alasan_ditolak" => "required",
        ]);

        #cek barang jika jumlah barang lebih dari barang complain
        if($req->jumlah_beli <= $req->complain_jumlah){
            return redirect()->back()->with('message_fail','Jumlah complain lebih dari jumlah beli');
        }

        $total_return = $req->complain_jumlah*$req->hpp;

        $model = CBJ::updateOrCreate(
            [
                'id_detail_sales'=> $req->id_detail_sales,
                'id_sales'=> $req->id_sales,
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
            ],
            [
                'id_barang'=> $req->id_barang,
                'hpp'=> $req->hpp,
                'jumlah_beli'=> $req->jumlah_beli,
                'diskon_item'=> $req->diskon_item,
                'complain_jumlah'=> $req->complain_jumlah,
                'complain_kualitas'=> $req->complain_kualitas,
                'total_return'=>$total_return,
                'ket'=> $req->ket,
                'status_complain'=> $req->status_complain,
                'alasan_ditolak'=> $req->alasan_ditolak,
                'id_karyawan'=>Session::get('id_karyawan'),
            ]
        );
        if($model->save()){
            return redirect()->back()->with('message_success', 'Data complain telah tersimpan');
        }else{
            return redirect()->back()->with('message_fail', 'Data complain gagal tersimpan');
        }
    }
}
