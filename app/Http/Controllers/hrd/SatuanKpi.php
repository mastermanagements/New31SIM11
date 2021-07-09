<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\SatuanKPI as satuanKPis;

class SatuanKpi extends Controller
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
            'data'=> satuanKPis::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.SatuanKPI.page_default', $data);
    }

    public function store(Request $req){

        $this->validate($req,[
           'satuan_kpi'=>'required'
        ]);

        $model =new satuanKPis();
        $model->satuan_kpi = $req->satuan_kpi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('satuan-kpi')->with('message_success', 'Anda telah menambahkan Satuan KPI Baru');
        }else {
            return redirect('satuan-kpi')->with('message_fail', 'Maaf, Data satuan kpi gagal menyimpan disimpan');
        }
    }

    public function edit($id){

        if(empty($model = satuanKPis::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'satuan_kpi'=>'required',
            'id'=> 'required'
        ]);

        $model =satuanKPis::find($req->id);
        $model->satuan_kpi = $req->satuan_kpi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('satuan-kpi')->with('message_success', 'Anda telah mengubah Satuan KPI ');
        }else {
            return redirect('satuan-kpi')->with('message_fail', 'Maaf, Data satuan kpi gagal mengubah');
        }
    }

    public function delete(Request $req, $id){

        $model =satuanKPis::find($id);
        if($model->delete()){
            return redirect('satuan-kpi')->with('message_success', 'Anda telah menghapus Satuan KPI ');
        }else {
            return redirect('satuan-kpi')->with('message_fail', 'Maaf, Data satuan kpi gagal menghapus');
        }
    }
}
