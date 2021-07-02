<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\G_Bonus_Gaji as bonus;
use App\Model\Penggajian\G_Bonus_proyek as bonus_p;
use App\Model\Produksi\Proyek as proyek;


class G_Bonus_Gaji extends Controller
{
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

    public function store(Request $req){
        $this->validate($req,[
           'id_ky'=> 'required',
           'id_slip'=> 'required',
         ]);
        if(!empty($req->nm_bonus)){
            $nama_bonus = $req->nm_bonus;
            $jumlah_bonus =  $req->jumlah_bonus;
            $req->id_proyek=0;
            $req->id_kelas=0;
        }else{
            $nama_bonus ="dr_proyek";
            $model_proyek=proyek::find($req->id_proyek)->timOneProye;
            $model_bonus = bonus_p::where('id_tim_proyek', $model_proyek->id)->where('id_kelas_proyek', $req->id_kelas)->first();
            $jumlah_bonus = $model_bonus->besar_tunjangan;
        }

        $model =  new bonus();
        $model->id_ky = $req->id_ky;
        $model->id_slip = $req->id_slip;
        $model->id_proyek = $req->id_proyek;
        $model->id_kelas = $req->id_kelas;
        $model->nama_bonus = $nama_bonus;
        $model->besaran_bonus = $jumlah_bonus;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('item-gaji/'.$model->id_slip)->with('message_success','Anda telah menambahkan bonus gaji');
        }else{
            return redirect('item-gaji/'.$model->id_slip)->with('message_fail','Maaf, Bonus gaji tidak tersimpan');
        }

    }

    public function delete(Request $req, $id){
        $model = bonus::find($id);
        if($model->delete()){
            return redirect('item-gaji/'.$model->id_slip)->with('message_success','Anda telah menghapus bonus gaji');
        }else{
            return redirect('item-gaji/'.$model->id_slip)->with('message_fail','Maaf, Bonus gaji tidak terhapus');
        }
    }

}
