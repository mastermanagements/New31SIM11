<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Barang;
use Session;
use App\Model\Manufaktur\P_SOP_Produksi;
use App\Model\Manufaktur\P_barang_Sop;
class BarangSOP extends Controller
{
    //
    public function show($id_sop_produksi){
        $array = [
            'id_sop_produksi'=> $id_sop_produksi,
            'sop_produksi'=> P_SOP_Produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_sop_produksi),
            'barang'=> Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get()
        ];
        return view('user.manufaktur.pages.barang_sop.page_create', $array);
    }

    public function store(Request $req){
        $this->validate($req,[
            'id_sop_pro'=> 'required',
            'id_barang'=> 'required'
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan']= Session::get('id_perusahaan_karyawan');
        $model = new P_barang_Sop($data);
        if($model->save()){
            return redirect()->back()->with('message_success','Barang produksi telah ditambahkan');
        }else{
            return redirect()->back()->with('message_fail','Barang produksi gagal ditambahkan');
        }
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_sop_pro'=> 'required',
            'id_barang'=> 'required'
        ]);
        $data = $req->except(['_token']);
        $data['id_perusahaan']= Session::get('id_perusahaan_karyawan');
        $model = P_barang_Sop::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->update($data)){
            return redirect()->back()->with('message_success','Barang produksi telah diubah');
        }else{
            return redirect()->back()->with('message_fail','Barang produksi gagal ditambahkan');
        }
    }

    public function destroy(Request $req, $id){
        $model = P_barang_Sop::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect()->back()->with('message_success','Barang produksi telah dihapus');
        }else{
            return redirect()->back()->with('message_fail','Barang produksi gagal dihapus');
        }
    }
}
