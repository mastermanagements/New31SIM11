<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Manufaktur\P_SOP_Produksi;
use Session;

class ProsesProduksi extends Controller
{
    //
    public function create(){
        return view('user.manufaktur.pages.SOP_produksi.page_create');
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'nama_sop'=>''
        ]);

        $data = $req->except(['_token']);
        $data['id_perusahaan']= Session::get('id_perusahaan_karyawan');
        $data['id_karyawan']= Session::get('id_karyawan');
        $model = new P_SOP_Produksi($data);
        if($model->save()){
            return redirect('manufaktur')->with('message_success','Sop Produksi telah ditambahkan');
        }else{
            return redirect('manufaktur')->with('message_fail','Sop Produksi gagal ditambahkan');
        }
    }

    public function edit($id){
        $array = [
            'p_sop'=> P_SOP_Produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
        return view('user.manufaktur.pages.SOP_produksi.page_edit', $array);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'nama_sop'=>''
        ]);
        $model = P_SOP_Produksi::findOrFail($id);
        $data = $req->except(['_token']);
        $data['id_perusahaan']= Session::get('id_perusahaan_karyawan');
        $data['id_karyawan']= Session::get('id_karyawan');

        if($model->update($data)){
            return redirect('manufaktur')->with('message_success','Sop Produksi telah diubah');
        }else{
            return redirect('manufaktur')->with('message_fail','Sop Produksi gagal diubah');
        }
    }

    public function destroy(Request $req, $id)
    {
        $this->validate($req,[
            'nama_sop'=>''
        ]);
        $model = P_SOP_Produksi::findOrFail($id);
        if($model->delete()){
            return redirect('manufaktur')->with('message_success','Sop Produksi telah dihapus');
        }else{
            return redirect('manufaktur')->with('message_fail','Sop Produksi gagal dihapus');
        }
    }
}
