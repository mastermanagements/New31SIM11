<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Marketing\Promo as prom;
use Session;
class Promo extends Controller
{
    //

    public function store(Request $req){
        $this->validate($req,[
            'nm_promo'=> 'required',
            'jenis_promo'=> 'required',
            'tgl_awal_promo'=> 'required',
            'tgl_akhir_promo'=> 'required',
            'syarat'=> 'required',
            'fasilitas'=> 'required',
        ]);

        $model = new prom();
        $model->jenis_promo = $req->jenis_promo;
        $model->nama_promo = $req->nm_promo;
        $model->syarat = $req->syarat;
        $model->fasilitas_promo = $req->fasilitas;
        $model->tgl_dibuat = $req->tgl_awal_promo;
        $model->tgl_berlaku = $req->tgl_akhir_promo;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            return redirect('Barang')->with('message_sucess','Even telah dibuat')->with('tab6','tab6');
        }else{
            return redirect('Barang')->with('message_error','Even gagal dibuat')->with('tab6','tab6');
        }
    }

    public function edit($id){
        $model = prom::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        return response()->json($model);
    }

    public function delete_promo(Request $req, $id){
        $this->validate($req,[
            '_token'=>'required'
        ]);
        $model = prom::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('Barang')->with('message_sucess','Even telah dihapus')->with('tab6','tab6');
        }else{
            return redirect('Barang')->with('message_error','Even gagal dihapus')->with('tab6','tab6');
        }
    }

    public function update(Request $req, $id){

         $this->validate($req,[
            'nm_promo'=> 'required',
            'jenis_promo'=> 'required',
            'tgl_awal_promo'=> 'required',
            'tgl_akhir_promo'=> 'required',
            'syarat'=> 'required',
            'fasilitas'=> 'required',
        ]);

        $model = prom::findOrFail($id);
        $model->jenis_promo = $req->jenis_promo;
        $model->nama_promo = $req->nm_promo;
        $model->syarat = $req->syarat;
        $model->fasilitas_promo = $req->fasilitas;
        $model->tgl_dibuat = $req->tgl_awal_promo;
        $model->tgl_berlaku = $req->tgl_akhir_promo;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        if($model->save()){
            return redirect('Barang')->with('message_sucess','Even telah dibuat')->with('tab6','tab6');
        }else{
            return redirect('Barang')->with('message_error','Even gagal dibuat')->with('tab6','tab6');
        }
    }

}
