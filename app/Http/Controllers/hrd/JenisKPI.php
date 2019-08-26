<?php

namespace App\Http\Controllers\hrd;

use App\Model\Hrd\SatuanKPI as satuanKPis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\JenisKPI as jenisK;

class JenisKPI extends Controller
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
        $data=[
            'data'=> jenisK::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.jenisKPI.page_default', $data);
    }

    public function store(Request $req){

        $this->validate($req,[
           'jenis_kpi'=> 'required'
        ]);

        $model = new jenisK();
        $model->jenis_kpi = $req->jenis_kpi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('jenis-kpi')->with('message_success', 'Anda telah menambahkan jenis kpi baru');
        }else{
            return redirect('jenis-kpi')->with('message_fail', 'Maaf, Jenis Kpi gagal untuk disimpan');
        }
    }

    public function edit($id){
        if(empty($model = jenisK::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){

        $this->validate($req,[
            'jenis_kpi'=> 'required',
            'id'=>'required'
        ]);

        $model = jenisK::find($req->id);
        $model->jenis_kpi = $req->jenis_kpi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('jenis-kpi')->with('message_success', 'Anda telah mengubah jenis kpi baru');
        }else{
            return redirect('jenis-kpi')->with('message_fail', 'Maaf, Jenis Kpi gagal untuk diubah');
        }
    }

    public function delete(Request $req, $id){

        $model = jenisK::find($req->id);
        if($model->delete()){
            return redirect('jenis-kpi')->with('message_success', 'Anda telah menghapus jenis kpi baru');
        }else{
            return redirect('jenis-kpi')->with('message_fail', 'Maaf, Jenis Kpi gagal untuk dihapus');
        }
    }

}
