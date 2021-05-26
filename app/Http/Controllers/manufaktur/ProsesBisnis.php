<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Manufaktur\P_SOP_Produksi;
use Session;
use App\Model\Manufaktur\P_Proses_Bisnis;
use App\Model\Manufaktur\P_tambah_produksi;
class ProsesBisnis extends Controller
{
    //
    public function show($id){
        $array=[
            'sop_produksi'=> P_SOP_Produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
        return view('user.manufaktur.pages.proses_bisnis.page_create', $array);
    }

    public function store(Request $req){
       //dd($req->all());
        $this->validate($req, [
           //'id_sop_pro'=> 'required',
           'proses_bisnis'=> 'required'
        ]);


        $proses_bisnis = $req->proses_bisnis;
        $ket = $req->ket;
        $id_sop_pro = $req->id_sop_pro;

        foreach ($proses_bisnis as $key => $value)
        {
          $model = new P_Proses_Bisnis();
          $model->proses_bisnis = $value;
          $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
          $model->id_karyawan = Session::get('id_karyawan');
          $model->id_sop_pro= $id_sop_pro[$key];
          $model->ket = $ket[$key];
          $model->save();
        }

        if($model->save()== TRUE){
            return redirect('manufaktur')->with('message_success','Proses Bisnis telah ditambahkan');
        }else{
            return redirect('manufaktur')->with('message_fail','Proses Bisnis Gagal ditambahkan');
        }
    }

    public function edit($id){
        $array=[
            'proses_bisnis'=> P_Proses_Bisnis::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id)
        ];
        return view('user.manufaktur.pages.proses_bisnis.page_edit', $array);
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
