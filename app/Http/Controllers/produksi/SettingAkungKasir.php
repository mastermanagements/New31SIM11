<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\SettingKasir;
use Session;
use App\Model\Superadmin_ukm\H_karyawan;
use App\Model\Keuangan\AkunAktifUkm;
use App\Model\Produksi\SettingAkunKasir as ASK;
class SettingAkungKasir extends Controller
{
    public function show($id_setting_akun){
        $data =[
            'data'=>SettingKasir::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id_setting_akun),
            'karyawan'=> h_karyawan::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'akun_aktif'=>AkunAktifUkm::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.produksi.section.jualbarang.settingkasir.akunKasir.page_detail', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'id_shift_kasir'=> 'required',
            'id_akun_aktif'=> 'required',
        ]);

        $model = new ASK();
        $model->id_shift_kasir = $req->id_shift_kasir;
        $model->id_akun_aktif = $req->id_akun_aktif;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            return redirect('setting-akun-kasir/'. $req->id_shift_kasir)->with('message_success','Akun telah ditambahkan');
        }else{
            return redirect('setting-akun-kasir/'. $req->id_shift_kasir)->with('message_fail','Akun gagal ditambahkan');
        }
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'id_shift_kasir'=> 'required',
            'id_akun_aktif'=> 'required',
        ]);

        $model = ASK::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        $model->id_shift_kasir = $req->id_shift_kasir;
        $model->id_akun_aktif = $req->id_akun_aktif;
        $model->id_perusahaan = Session::get('id_perusahaan_karyawan');
        $model->id_karyawan = Session::get('id_karyawan');
        if($model->save()){
            return redirect('setting-akun-kasir/'. $req->id_shift_kasir)->with('message_success','Akun telah diubah');
        }else{
            return redirect('setting-akun-kasir/'. $req->id_shift_kasir)->with('message_fail','Akun gagal diubah');
        }
    }

    public function delete($id){
        $model = ASK::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($id);
        if($model->delete()){
            return redirect('setting-akun-kasir/'. $model->id_shift_kasir)->with('message_success','Akun telah dihapus');
        }else{
            return redirect('setting-akun-kasir/'. $model->id_shift_kasir)->with('message_fail','Akun gagal dihapus');
        }
    }
}
