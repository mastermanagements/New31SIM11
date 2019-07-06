<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;
use App\Model\Penggajian\CompansableFators as cf;
class CompansableFactors extends Controller
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
            'jabatan'=> jabatan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.CompansableFactors.page_default', $data);
    }

    public function store(Request $req){

        $this->validate($req,[
            'id_jabatan'=> 'required',
            'faktor'=> 'required',
            'bobot_cf'=> 'required',
        ]);

        $model =new cf();
        $model->id_jabatan = $req->id_jabatan;
        $model->faktor = $req->faktor;
        $model->bobot = $req->bobot_cf;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Compansable-factors')->with('message_success','Anda telah menambahkan Compansable Faktor baru');
        }else{
            return redirect('Compansable-factors')->with('message_fail','Maaf, Gagal menambahkan Compansable Faktor Baru');
        }
    }

}
