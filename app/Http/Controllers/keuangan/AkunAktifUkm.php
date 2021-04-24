<?php

namespace App\Http\Controllers\keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Keuangan\Akun as akun_master; //k_akun_ukm
use App\Model\Keuangan\AkunAktifUkm as AAU; //k_akun_aktif_ukm

class AkunAktifUkm extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;

    public function __construct()
    {
        $this->middleware(function($req, $next){
            if(empty(Session::get('id_karyawan')) && empty(Session::get('id_perusahaan_karyawan')))
            {
                Session::flush();
                return redirect('login-karyawan')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }


    public function store(Request $req){
        $this->validate($req,[
            'akun_ukm'=> 'required'
        ]);

        foreach ($req->akun_ukm as $value){
            $model_akun_ukm = akun_master::find($value);
            foreach ($model_akun_ukm->sub_akun_ukm->where('off_on','1') as $sub_akun){
                $model_aau = AAU::updateOrCreate(
                    ['id_sub_akun'=>$sub_akun->id,'id_subsub_akun'=>0,'id_perusahaan'=>$this->id_perusahaan],
                    ['kode_akun_aktif'=> $sub_akun->kode_sub_akun,'nm_akun_aktif'=>$sub_akun->nm_sub_akun,'id_karyawan'=>$this->id_karyawan,'posisi_saldo'=>$sub_akun->posisi_saldo]
                )->save();
                foreach ($sub_akun->subsub_ukm->where('off_on','1') as $sub_sub_akun){
                    $model_aau2 = AAU::updateOrCreate(
                        ['id_sub_akun'=>$sub_akun->id,'id_subsub_akun'=>$sub_sub_akun->id,'id_perusahaan'=>$this->id_perusahaan],
                        ['kode_akun_aktif'=> $sub_sub_akun->kode_subsub_akun,'nm_akun_aktif'=>$sub_sub_akun->nm_subsub_akun,'id_karyawan'=>$this->id_karyawan,'posisi_saldo'=>$sub_akun->posisi_saldo]
                    )->save();
                }
            }
        }
        //
        return redirect('daftar-akun')->with('message_success','Anda telah mengaktifkan daftar akun');
    }
}
