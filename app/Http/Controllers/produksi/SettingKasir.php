<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\H_karyawan;
use Session;
use App\Model\Produksi\SettingKasir as SK;


class SettingKasir extends Controller
{
    //

    public function create(){
        $data = [
            'karyawan'=> h_karyawan::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
        ];
        return view('user.produksi.section.jualbarang.settingkasir.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'id_karyawan'=> 'required',
           'shift'=> 'required',
        ]);

        $model = new SK();
        $model->kasir = $req->id_karyawan;
        $model->shift = $req->shift;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            return redirect('Penjualan')->with('message_success','setting pengaturan kasir telah ditambahkan');
        }else{
            return redirect('Penjualan')->with('message_error','setting pengaturan kasir gagal ditambahkan');
        }
    }

    public function edit($id){
        $data = [
            'data'=>SK::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id),
            'karyawan'=> h_karyawan::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
        ];
        return view('user.produksi.section.jualbarang.settingkasir.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_karyawan'=> 'required',
            'shift'=> 'required',
        ]);

        $model = SK::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->kasir = $req->id_karyawan;
        $model->shift = $req->shift;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            return redirect('Penjualan')->with('message_success','setting pengaturan kasir telah diubah');
        }else{
            return redirect('Penjualan')->with('message_error','setting pengaturan kasir gagal diubah');
        }
    }

    public function destroy (Request $req, $id){
        $model = SK::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('Penjualan')->with('message_success','setting pengaturan kasir telah dihapus');
        }else{
            return redirect('Penjualan')->with('message_error','setting pengaturan kasir gagal dihapus');
        }
    }
}
