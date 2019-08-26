<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_aku as haku;
use App\Model\Superadmin_UKM\H_karyawan as ky;
use App\Model\Hrd\H_Kpi as kpi;
use App\Model\Hrd\H_kpi_karyawan as kpi_ky;

class KpiKaryawan extends Controller
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
          'H_aku' => haku::all()->where('id_perusahaan', $this->id_perusahaan),
          'ky'=> ky::all()->where('id_perusahaan', $this->id_perusahaan),
          'kpi' => kpi::all()->where('id_perusahaan', $this->id_perusahaan),
          'h_kpi'=> kpi_ky::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.KPIKaryawan.page_default', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            "thn_kpi"=>"required",
            "id_ky"=>"required",
            "id_aku"=>"required",
            "id_kpi"=>"required",
            "realisasi_kpi"=>"required",
        ]);

        $kpi = kpi::find($req->id_kpi);
        $skor_kpi = $req->realisasi_kpi/$kpi->targat_kpi*100;
        $skor_akhir =$skor_kpi * $kpi->bobot_kpi/100;

        $model = new kpi_ky();
        $model->year = $req->thn_kpi;
        $model->id_ky = $req->id_ky;
        $model->id_aku = $req->id_aku;
        $model->id_kpi = $req->id_kpi;
        $model->realisasi_kpi = $req->realisasi_kpi;
        $model->skor_kpi = $skor_kpi;
        $model->skor_akhir = $skor_akhir;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Kpi-karyawan')->with('message_success', 'Anda telah menambahkan Kpi Karyawan baru');
        }else{
            return redirect('Kpi-karyawan')->with('message_fail', 'Maaf, gagal untuk menambahkan Kpi karyawan');
        }

    }

    public function edit($id){
        if(empty($model = kpi_ky::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req)
    {
        $this->validate($req,[
            "thn_kpi"=>"required",
            "id_ky"=>"required",
            "id_aku"=>"required",
            "id_kpi"=>"required",
            "realisasi_kpi"=>"required",
            "id"=>"required",
        ]);

        $kpi = kpi::find($req->id_kpi);
        $skor_kpi = $req->realisasi_kpi/$kpi->targat_kpi*100;
        $skor_akhir =$skor_kpi * $kpi->bobot_kpi/100;

        $model = kpi_ky::find($req->id);
        $model->year = $req->thn_kpi;
        $model->id_ky = $req->id_ky;
        $model->id_aku = $req->id_aku;
        $model->id_kpi = $req->id_kpi;
        $model->realisasi_kpi = $req->realisasi_kpi;
        $model->skor_kpi = $skor_kpi;
        $model->skor_akhir = $skor_akhir;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Kpi-karyawan')->with('message_success', 'Anda telah mengubah Kpi Karyawan baru');
        }else{
            return redirect('Kpi-karyawan')->with('message_fail', 'Maaf, gagal untuk mengubah Kpi karyawan');
        }

    }

    public function delete(Request $req, $id)
    {
        $model = kpi_ky::find($id);
        if($model->delete()){
            return redirect('Kpi-karyawan')->with('message_success', 'Anda telah menghapus Kpi Karyawan baru');
        }else{
            return redirect('Kpi-karyawan')->with('message_fail', 'Maaf, gagal untuk menghapus Kpi karyawan');
        }
    }

}
