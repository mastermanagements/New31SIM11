<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\Proyek as proyek;
use App\Model\Penggajian\G_kelas_proyek as gkp;
use App\Model\Penggajian\G_Bonus_proyek as Gbp;

class SkalaBonusProyek extends Controller
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

    public function create($id){
        if(empty($model = proyek::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        Session::put('menu_tun','BonusProyek');
        Session::put('menu_sub_tun','SkalaBonusProyek');
        $data = [
            'proyek'=> $model,
            'kelas_proyek' => gkp::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.Tunjangan.page_default', $data);
    }

    public function store(Request $req, $id_proyek){
        $this->validate($req,[
            'apt' => 'required',
            'id_kelas_proyek'=>'required',
            'id_tim_proyek'=> 'required'
        ]);

        foreach ($req->id_kelas_proyek as $key=> $id_kelas){
            $besaranKelas = gkp::find($id_kelas);
            if(empty($models = Gbp::where('id_tim_proyek', $req->id_tim_proyek)->where('id_kelas_proyek',$id_kelas )->first())){
                $model = new Gbp();
                $model->id_tim_proyek = $req->id_tim_proyek;
                $model->nilai_apt = $req->apt;
                $model->id_kelas_proyek = $id_kelas;
                $model->besar_tunjangan = ($besaranKelas->persen_besar_proyek/100)*$req->apt;
                $model->id_perusahaan = $this->id_perusahaan;
                $model->id_karyawan = $this->id_karyawan;
                $model->save();
            }else{
                $models->id_tim_proyek = $req->id_tim_proyek;
                $models->nilai_apt = $req->apt;
                $models->id_kelas_proyek = $id_kelas;
                $models->besar_tunjangan = ($besaranKelas->persen_besar_proyek/100)*$req->apt;
                $models->id_perusahaan = $this->id_perusahaan;
                $models->id_karyawan = $this->id_karyawan;
                $models->save();
            }

        }
        return redirect('Skala-bonus-proyek/'.$id_proyek)->with('message_success', 'Proses Perhitungan Bonus Proyek Selesai');
    }

}
