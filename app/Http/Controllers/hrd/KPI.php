<?php

namespace App\Http\Controllers\hrd;

use App\Model\Hrd\H_aku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\JenisKPI as jenisKPI;
use App\Model\Hrd\H_aku as aku;
use App\Model\Hrd\SatuanKPI as satuanKpi;
use App\Model\Hrd\H_Kpi as H_kpi;


class KPI extends Controller
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

    public function index()
    {
        $data = [
            'jenisKpi'=> jenisKPI::all()->where('id_perusahaan', $this->id_perusahaan),
            'H_aku'=> aku::all()->where('id_perusahaan', $this->id_perusahaan),
            'satuanKPi'=> satuanKpi::all()->where('id_perusahaan', $this->id_perusahaan),
            'data'=>H_kpi::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.KPI.page_default', $data);
    }

    public function store(Request $req){

       $this->validate($req, [
            'id_aku'=> 'required',
            'nm_kpi'=> 'required',
            'bobot_kpi'=> 'required',
            'target_kpi'=> 'required',
            'id_satuan'=> 'required',
            'id_jenis_kpi'=> 'required',
        ]);

        $model = new H_kpi();
        $model->id_aku = $req->id_aku;
        $model->nm_kpi = $req->nm_kpi;
        $model->bobot_kpi = $req->bobot_kpi;
        $model->targat_kpi = $req->target_kpi;
        $model->id_satuan_kpi = $req->id_satuan;
        $model->id_jenis_kpi = $req->id_jenis_kpi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Kpi')->with('message_success', 'Anda telah menambahkan KPI baru');
        }else{
            return redirect('Kpi')->with('message_fail', 'Maaf, telah terjadi kelasahan silahkan coba lagi');
        }
    }

    public function edit($id){
        if(empty($model = H_kpi::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){

        $this->validate($req, [
            'id'=> 'required',
            'id_aku'=> 'required',
            'nm_kpi'=> 'required',
            'bobot_kpi'=> 'required',
            'target_kpi'=> 'required',
            'id_satuan'=> 'required',
            'id_jenis_kpi'=> 'required',
        ]);

        $model = H_kpi::find($req->id);
        $model->id_aku = $req->id_aku;
        $model->nm_kpi = $req->nm_kpi;
        $model->bobot_kpi = $req->bobot_kpi;
        $model->targat_kpi = $req->target_kpi;
        $model->id_satuan_kpi = $req->id_satuan;
        $model->id_jenis_kpi = $req->id_jenis_kpi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Kpi')->with('message_success', 'Anda telah mengubah KPI');
        }else{
            return redirect('Kpi')->with('message_fail', 'Maaf, telah terjadi kelasahan silahkan coba lagi');
        }
    }

    public function delete(Request $req, $id){
        $model = H_kpi::find($id);
        if($model->delete()){
            return redirect('Kpi')->with('message_success', 'Anda telah menghapus KPI');
        }else{
            return redirect('Kpi')->with('message_fail', 'Maaf, telah terjadi kelasahan silahkan coba lagi');
        }
    }

}
