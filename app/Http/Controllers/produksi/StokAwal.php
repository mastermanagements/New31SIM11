<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\Barang;
use App\Model\Produksi\StokAwal as stok_awal;
use App\Http\Controllers\produksi\utils\StokBarangOperation;
class StokAwal extends Controller
{
    //
    public function index(){
        $data = [
            'menu'=>'stok_awal',
            'data_stok'=> stok_awal::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.inventory.page_default', $data);
    }

    public function create(){
        $data = [
          'barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.inventory.stok_awal.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'id_barang'=>'required',
            'jumlah_brg'=>'required',
            'expired_date'=>'required',
        ]);

        $model = stok_awal::updateOrCreate(
            [
                'id_barang'=> $req->id_barang,
                'id_perusahaan'=>Session::get('id_perusahaan_karyawan')
            ],
            [
                'jumlah_brg'=>$req->jumlah_brg,
                'expired_date'=>$req->expired_date,
            ]
        );

        if($model){
            StokBarangOperation::operation($model,'stok_awal');
            return redirect('inventory')->with('message_success','Data Stok telah disimpan');
        }else{
            return redirect('inventory')->with('message_fail','Data Stok gagal disimpan');
        }
    }

    public function edit($id){
        dd(stok_awal::findOrFail($id));
        $data = [
            'barang'=> Barang::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data_stok'=> stok_awal::findOrFail($id)
        ];
        return view('user.produksi.section.inventory.stok_awal.page_edit', $data);
    }

    public function update(Request $req, $id){

        $this->validate($req,[
            'id_barang'=>'required',
            'jumlah_brg'=>'required',
            'expired_date'=>'required',
        ]);

        $model = stok_awal::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        $model->id_barang = $req->id_barang;
        $model->jumlah_brg = $req->jumlah_brg;
        $model->expired_date = $req->expired_date;

        if($model->save()){
            StokBarangOperation::operation($model,'stok_awal');
            return redirect('inventory')->with('message_success','Data Stok telah diubah');
        }else{
            return redirect('inventory')->with('message_fail','Data Stok gagal diubah');
        }

    }

    public function delete(Request $req, $id){

        $model = stok_awal::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->find($id);
        if($model->delete()){
            return redirect('inventory')->with('message_success','Data Stok telah dihapus');
        }else{
            return redirect('inventory')->with('message_fail','Data Stok gagal dihapus');
        }

    }

}
