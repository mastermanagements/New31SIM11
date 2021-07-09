<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Penggajian\CompansableFators as cf;
use Session;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;
use App\Model\Penggajian\SkorPosisiCF as spcf;
class SkorPosisiCF extends Controller
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

    public function index(){
        $data = [
            'cf'=> cf::all()->where('id_perusahaan', $this->id_perusahaan),
            'jabatan'=>jabatan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.ContentCF.SkorCF.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'id_jabatan'=>'required'
        ]);

        foreach ($req->id_sub_cf as $index => $id_sub_cf) {
            if(!empty($req->skor_sub_cf[$index]) || $req->skor_sub_cf[$index]==0){
                $id_sub = $id_sub_cf ;
                $model = spcf::where('id_sub_cf',$id_sub)->where('id_jabatan', $req->id_jabatan)->first();
                if(empty($model)){
                    $model_insert=new spcf();
                    $model_insert->id_sub_cf = $id_sub_cf;
                    $model_insert->skor_sub_cf = $req->skor_sub_cf[$index];
                    $model_insert->id_jabatan = $req->id_jabatan;
                    $model_insert->id_perusahaan = $this->id_perusahaan;
                    $model_insert->id_karyawan = $this->id_karyawan;
                    $model_insert->save();
                }else{
                    $model->id_sub_cf = $id_sub;
                    $model->skor_sub_cf = $req->skor_sub_cf[$index];
                    $model->id_jabatan = $req->id_jabatan;
                    $model->id_perusahaan = $this->id_perusahaan;
                    $model->id_karyawan = $this->id_karyawan;
                    $model->save();
                }
            }
       }

        return redirect('stok-total-compensable-factor')->with('message_success','Skor baru saja di tambahkah');
    }
}
