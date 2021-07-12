<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\superadmin_ukm\H_karyawan as ky;
use App\Model\Hrd\H_absensi as h_ab;


class Absensi extends Controller
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
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function index(){
        $data=[
            'data'=> h_ab::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.absen.page_default', $data);
    }

    public function create(){
        $data = [
            'data_karyawan'=>ky::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.absen.page_create', $data);
    }


    public function store(Request $req){
        $this->validate($req,[
           'id_ky' => 'required',
           'periode' => 'required',
           'normal_hari' => 'required',
           'hadir' => 'required',
           'terlambat_masuk' => 'required',
           'tdk_absen_m' => 'required',
           'tdk_absen_p' => 'required',
           'jum_izin' => 'required',
        ]);

        $model = new h_ab();
        $model->id_ky=$req->id_ky;
        $model->periode=date('Y-m-d', strtotime($req->periode));
        $model->normal_hari=$req->normal_hari;
        $model->hadir=$req->terlambat_masuk;
        $model->terlambat_masuk=$req->hadir;
        $model->tidak_absen_m=$req->tdk_absen_m;
        $model->tidak_absen_p=$req->tdk_absen_p;
        $model->jum_izin=$req->jum_izin;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save()){
            return redirect('Absensi')->with('message_success','Anda telah menambahkan data absen baru');
        }else{
            return redirect('Absensi')->with('message_fail','Maaf, data absen baru gagal untuk disimpan');
        }
    }

    public function edit($id){
        if(empty($model = h_ab::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            'data_karyawan'=>ky::all()->where('id_perusahaan', $this->id_perusahaan),
            'data' =>$model
        ];
        return view('user.hrd.section.absen.page_edit', $data);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_ky' => 'required',
            'periode' => 'required',
            'normal_hari' => 'required',
            'hadir' => 'required',
            'terlambat_masuk' => 'required',
            'tdk_absen_m' => 'required',
            'tdk_absen_p' => 'required',
            'jum_izin' => 'required',
        ]);

        $model = h_ab::find($id);
        $model->id_ky=$req->id_ky;
        $model->periode=date('Y-m-d', strtotime($req->periode));
        $model->normal_hari=$req->normal_hari;
        $model->hadir=$req->terlambat_masuk;
        $model->terlambat_masuk=$req->hadir;
        $model->tidak_absen_m=$req->tdk_absen_m;
        $model->tidak_absen_p=$req->tdk_absen_p;
        $model->jum_izin=$req->jum_izin;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save()){
            return redirect('Absensi')->with('message_success','Anda telah mengubah data absen baru');
        }else{
            return redirect('Absensi')->with('message_fail','Maaf, data absen baru gagal untuk diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = h_ab::find($id);
        if($model->delete()){
            return redirect('Absensi')->with('message_success','Anda telah menghapus data absen baru');
        }else{
            return redirect('Absensi')->with('message_fail','Maaf, data absen baru gagal untuk dihapus');
        }
    }

}
