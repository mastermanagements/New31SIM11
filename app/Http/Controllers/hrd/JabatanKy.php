<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_Jabatan_ky as jabatanKys;

class JabatanKy extends Controller
{
    //

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

    public function storeUpdate(Request $req){
        $this->validate($req,[
            'id_ky' => 'required',
            'id_jabatan_p' => 'required',
            'mulai_menjabat' => 'required',
            'selesai_menjabat' => 'required',
            'status_jabatan' => 'required',
        ]);

        $reqData = $req->except('_token');
        $reqData['mulai_menjabat'] = date('Y-m-d', strtotime($req->mulai_menjabat));
        $reqData['selesai_menjabat'] = date('Y-m-d', strtotime($req->selesai_menjabat));
        $model = jabatanKys::updateOrCreate(
            ['id_perusahaan'=> $this->id_perusahaan,'id_karyawan'=> $this->id_karyawan,'id_ky'=>$req->id_ky],$reqData
        );
        if($model->save()){
            return redirect('Karyawan')->with('message_success', 'Anda telah menambahkan jabatan');
        }else{
            return redirect('Karyawan')->with('message_fail', 'Anda telah menambahkan jabatan');
        }
    }

}
