<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as karyawans;
use App\Model\Hrd\H_tenaga_kerja as tenaga_kerja;


class TenagaKerja extends Controller
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

    public function index(){
        $data =[
            'data_karyawan' => karyawans::where('id_perusahaan', $this->id_perusahaan)->paginate(20),
        ];
        return view('user.hrd.section.tenaga_ahli.page_default', $data);
    }

    public function daftarSertifikasi($id)
    {
        if(empty($model = karyawans::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $model_sertifikasi = tenaga_kerja::all()->where('id_ky', $model->id);

        $data = [
            'data_profil_karyawan'=> $model,
            'sertifikasi'=>$model_sertifikasi
        ];
        return view('user.hrd.section.tenaga_ahli.crud.page_detail', $data);
    }
}
