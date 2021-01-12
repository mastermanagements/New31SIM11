<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\TawarBeli as TB;
use App\Model\Produksi\Barang;
use App\Model\Produksi\DetailTB;
use Session;
class TawarBeli extends Controller
{
    //
    public function show($id)
    {
        $model = TB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $barang = Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        return view('user.produksi.section.belibarang.barang_penawaran.page_create',['data'=> $model,'barang'=> $barang]);
    }

    public function store(Request $req){
        $this->validate($req,[
           'tgl_tawar' => 'required',
           'tgl_berlaku' => 'required',
           'id_supplier' => 'required',
        ]);

        $model= new TB();
        $model->no_tawar = 'no urut/Pre-PO/Singkatan usaha/tgl/bln/thn';
        $model->tgl_tawar = $req->tgl_tawar;
        $model->tgl_berlaku = $req->tgl_berlaku;
        $model->id_supplier = $req->id_supplier;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');

        if($model->save()){
            return redirect('Pembelian')->with('message_success','penawaran pembelian sudah dibuat');
        }else{
            return redirect('Pembelian')->with('message_fail','penawaran pembelian gagal dibuat');
        }
    }

    public function storePenawaranBarang(Request $req, $id){

        $this->validate($req,[
           'id_barang'=> 'required',
           'harga_baru'=> 'required',
           'jumlah_beli'=> 'required',
        ]);

        $model = new DetailTB();
        $model->id_tawar = $id;
        $model->id_barang = $req->id_barang;
        $model->hpp_baru = $req->harga_baru;
        $model->jumlah_beli = $req->jumlah_beli;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            return redirect()->back()->with('message_success','Barang penawaran telah ditambahkan');
        }else{
            return redirect()->back()->with('message_fail','Barang penawaran gagal ditambahkan');
        }
    }
}
