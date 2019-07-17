<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as ky;
use App\Model\Penggajian\DaftarGaji as DG;

class DaftarGaji extends Controller
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

    public function index(){
        $data =[
            'ky'=> ky::where('id_perusahaan', $this->id_perusahaan)->paginate(30)
        ];
        return view('user.penggajian.section.daftar_gaji.page_default', $data);
    }

    public function list($id_ky){
        if(empty($model_ky = ky::where('id', $id_ky)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            'data'=> $model_ky
        ];
        return view('user.penggajian.section.daftar_gaji.page_create', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'periode'=> 'required',
            'id_ky'=> 'required',
            'besar_gaji'=> 'required',
         ]);

        $model = new DG();
        $model->priode =$req->periode;
        $model->id_ky =$req->id_ky;
        $model->besar_gaji =$req->besar_gaji;
        $model->ket =$req->ket;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan =$this->id_karyawan;

        if($model->save()){
            return redirect('detail-daftar-gaji/'.$model->id_ky)->with('message_success','Anda telah menambahkan data gaji baru');
        }else{
            return redirect('detail-daftar-gaji/'.$model->id_ky)->with('message_fail','Maaf, Data Gaji Tidak dapat disimpan');
        }
    }

}
