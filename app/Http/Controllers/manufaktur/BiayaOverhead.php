<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Manufaktur\P_tambah_produksi;
use App\Model\Manufaktur\P_item_overhead;
use App\Model\Manufaktur\P_biaya_overhead;

class BiayaOverhead extends Controller
{
    //
    /* public function show($id_tambah_produksi){
        $model = P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrfail($id_tambah_produksi);
        $array = [
            'data_tambah_produksi'=> $model,
            'item_over_head'=>P_item_overhead::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data_biaya_overhead'=> P_biaya_overhead::all()->where('id_tambah_produksi', $model->id)->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.manufaktur.pages.barang_produksi.biaya_overhead.page_show', $array);
    } */

    public function store(Request $req){
       $this->validate($req,[
            'id_tambah_produksi'=> 'required',
            'id_item_overhead'=> 'required',
            'jumlah_biaya'=> 'required',
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan']=Session::get('id_perusahaan_karyawan');
        $data['id_karyawan']=Session::get('id_karyawan');
        $data['jumlah_biaya'] = rupiahController($req->jumlah_biaya);

        $model = new P_biaya_overhead($data);
        if($model->save()){
            return redirect()->back()->with('message_success','Biaya overhead telah disimpan')->with('tab2','tab2');
        }else{
            return redirect()->back()->with('message_success','Biaya overhead gagal disimpan')->with('tab2','tab2');
        }
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_tambah_produksi'=> 'required',
            'id_item_overhead'=> 'required',
            'jumlah_biaya'=> 'required',
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan']=Session::get('id_perusahaan_karyawan');
        $data['id_karyawan']=Session::get('id_karyawan');
        $data['jumlah_biaya'] = rupiahController($req->jumlah_biaya);
        
        $model = P_biaya_overhead::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->update($data)){
            return redirect()->back()->with('message_success','Biaya overhead telah diubah')->with('tab2','tab2');
        }else{
            return redirect()->back()->with('message_success','Biaya overhead gagal diubah')->with('tab2','tab2');
        }
    }

    public function destroy(Request $req, $id){
        $model = P_biaya_overhead::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect()->back()->with('message_success','Biaya overhead telah dihapus')->with('tab2','tab2');
        }else{
            return redirect()->back()->with('message_success','Biaya overhead gagal dihapus')->with('tab2','tab2');
        }
    }
}
