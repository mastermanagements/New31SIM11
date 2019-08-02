<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\PeriodeInvestasi as PI;
use App\Investasi\I_data_investor as investor;
use App\Model\Investor\BentukInvestor as BI;
use App\Model\Investor\DaftarInvestasi as DI;

class DataInvestasi extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
    private  $id_con;

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
            $this->id_con=[
                'id_perusahaan'=> $this->id_perusahaan,
                'id_karyawan' => $this->id_karyawan
            ];
            return $next($req);
        });
    }

    public function index(){
        $data = [
            'periode_inves'=>PI::all()->where('id_perusahaan'),
            'bentuk_investor'=>BI::all()->where('id_perusahaan'),
            'data_investor'=>investor::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_investasi' =>DI::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.investor.section.dataInvestasi.page_default', $data);
    }

    public function store(Request $req){

        $this->validate($req,[
             "tgl_invest" => "required",
              "id_periode_invest" => "required",
              "id_investor" => "required",
              "jumlah_saham" => "required",
              "id_bentuk_invest" => "required",
        ]);

        $model = new DI();
        $model->tgl_invest = date('Y-m-d', strtotime($req->tgl_invest));
        $model->id_periode_invest = $req->id_periode_invest;
        $model->id_investor = $req->id_investor;
        $model->id_bentuk_invest = $req->id_bentuk_invest;
        $model->jumlah_saham = $req->jumlah_saham;

        $model_periode = PI::find($req->id_periode_invest)->saham_real->jum_saham;
        $jumlah_investasi = $model_periode * $model->jumlah_saham;
        $model->jumlah_investasi =$jumlah_investasi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Data-Investasi')->with('message_success','Anda telah menambahkan data investor');
        }else{
            return redirect('Data-Investasi')->with('message_fail','Maaf, data investor tidak tersimpan');
        }
    }
}
