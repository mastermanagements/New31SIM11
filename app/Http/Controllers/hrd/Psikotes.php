<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_psikotes as psikotess;
class Psikotes extends Controller
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
        $this->validate($req, [
           "tgl_tes" => "required",
           "id_lamaran_p" => "required",
           "id_jenis_psikotes" => "required",
           "nilai_akhir" => "required"
        ]);

        $tgl_tes = $req->tgl_tes;
        $id_lamaran_p = $req->id_lamaran_p;
        $id_jenis_psikotes = $req->id_jenis_psikotes;
        $nilai_akhir = $req->nilai_akhir;

        $model = psikotess::updateOrCreate(
            ['id_lamaran_p'=> $id_lamaran_p,'id_perusahaan'=> $this->id_perusahaan],
            ['tgl_tes'=> date('Y-m-d', strtotime($tgl_tes)), 'id_jenis_psikotes'=>$id_jenis_psikotes, 'nilai_akhir'=>$nilai_akhir,'id_karyawan'=> $this->id_karyawan]
        );

        if($model->save()){
            $feedback = [
              'message'=> 'Data Berhasil disimpan',
              'status'=> true
            ];
            return response()->json($feedback);
        }else{
            $feedback = [
                'message'=> 'Data Gagal untuk disimpan',
                'status'=> false
            ];
            return response()->json($feedback);
        }

    }
}
