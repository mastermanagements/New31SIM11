<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Manufaktur\P_SOP_Produksi;
use Session;
use App\Model\Manufaktur\P_Proses_Bisnis;
class ProsesProduksi extends Controller
{
    //
    public function show($id){
        $array=[
            'sop_produksi'=> P_SOP_Produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
        return view('user.manufaktur.pages.proses_produksi.page_create', $array);
    }

    public function store(Request $req){
        $this->validate($req, [
           'id_sop_pro'=> 'required',
           'proses_bisnis'=> 'required'
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = new P_Proses_Bisnis($data);
        if($model->save()){
            return redirect('manufaktur')->with('message_success','Proses Bisnis telah ditambahkan');
        }else{
            return redirect('manufaktur')->with('message_fail','Proses Bisnis Gagal ditambahkan');
        }
    }

    public function edit($id){
        $array=[
            'proses_bisnis'=> P_Proses_Bisnis::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
        return view('user.manufaktur.pages.proses_produksi.page_edit', $array);
    }

    public function update(Request $req, $id){
        $this->validate($req, [
            'id_sop_pro'=> 'required',
            'proses_bisnis'=> 'required'
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan'] = Session::get('id_perusahaan_karyawan');
        $data['id_karyawan'] = Session::get('id_karyawan');
        $model = P_Proses_Bisnis::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->update($data)){
            return redirect('manufaktur')->with('message_success','Proses Bisnis telah diubah');
        }else{
            return redirect('manufaktur')->with('message_fail','Proses Bisnis Gagal diubah');
        }
    }

    public function destroy(Request $req, $id){
        $model = P_Proses_Bisnis::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('manufaktur')->with('message_success','Proses Bisnis telah dihapus');
        }else{
            return redirect('manufaktur')->with('message_fail','Proses Bisnis Gagal dihapus');
        }
    }
}
