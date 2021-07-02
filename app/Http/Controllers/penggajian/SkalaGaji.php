<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\KlasifikasiGaji as KG;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;
use App\Model\Penggajian\GradeGaji as gg;
use App\Model\Penggajian\G_skala_gaji as gsg;
class SkalaGaji extends Controller
{
    //
    private $id_karyawan;
    private $id_perusahaan;

    public function __construct()
    {
        $this->middleware(function($req, $next)
        {
            if(empty(Session::get('id_karyawan')) && empty(Session::get('id_perusahaan_karyawan')))
            {
                Session::flush();
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function index()
    {
        $data =[
            'klasifikasiGaji'=> KG::all()->where('id_perusahaan', $this->id_perusahaan),
            'jabatan'=> jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
            'grader'=> gg::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.SkalaGaji.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'id_jabatan'=>'required'
        ]);

        foreach ($req->id_klasifikasi as $index => $id_klass){
            if(empty($model_gsg = gsg::where('id_jabatan', $req->id_jabatan)->where('id_klasifikasi', $id_klass)->where('id_perusahaan', $this->id_perusahaan)->first())){
                $model =  new gsg();
                $model->id_jabatan = $req->id_jabatan;
                $model->id_klasifikasi = $id_klass;
                $model->besaran_gaji = $req->besaran_gaji[$index];
                $model->id_perusahaan = $this->id_perusahaan;
                $model->id_karyawan = $this->id_karyawan;
                $model->save();
            }else{
                $model_gsg->id_jabatan = $req->id_jabatan;
                $model_gsg->id_klasifikasi = $id_klass;
                $model_gsg->besaran_gaji = $req->besaran_gaji[$index];
                $model_gsg->id_perusahaan = $this->id_perusahaan;
                $model_gsg->id_karyawan = $this->id_karyawan;
                $model_gsg->save();
            }
        }

        return redirect('Skala-Gaji')->with('message_success','Sudah diproses');
    }
}
