<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hrd\H_lamaran_pek as pelamar;
use App\Model\Hrd\H_hasil_tes as hasil_tes;
use Session;

class HasilTes extends Controller
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

    public function index($id){
        if(empty($model = pelamar::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort('404');
        }
        $data=[
            'pelamar'=> $model,
            'hasil'=> hasil_tes::where('id_lamaran_p',$model->id)->first()
        ];
        return view('user.hrd.section.tes.hasil.penilaian.page_create', $data);
    }

    public function save(Request $req, $id)
    {
        $this->validate($req,[
           'ket' => 'required'
        ]);

        $ket = $req->ket;
        $model =hasil_tes::updateOrCreate(
            ['id_lamaran_p'=> $id,'id_perusahaan'=> $this->id_perusahaan, 'id_karyawan'=> $this->id_karyawan],
            ['ket'=> $ket]
        );

        if($model->save()){
            return redirect('Hasil-tes')->with('anda telah menambahkan keterangan tambahan untuk :'. $model->lamaran->nm_pel);
        }else{
            return redirect('Hasil-tes')->with('Maaf, terlah terjadi kesalahan pada proses menambahkan keterangan untuk pelamar:'. $model->lamaran->nm_pel);
        }
    }

    public function show($id){
        $model = hasil_tes::where('id_lamaran_p', $id)->where('id_perusahaan', $this->id_perusahaan)->first();
        return response()->json($model);
    }
}
