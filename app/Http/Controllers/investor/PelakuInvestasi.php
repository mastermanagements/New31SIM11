<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as KY;
use App\Model\Investor\BentukInvestor as BI;
use App\Model\Investor\PeriodeInvestasi as PI;
use App\Model\Investor\Pelaksana as P;

class PelakuInvestasi extends Controller
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
        Session::put('menu-pelaku-saham','pelaksana');
        $data = [
            'data_ky' => KY::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_bi' => Bi::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_pi' => PI::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_p'  => P::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.investor.section.PelakuInvestasi.page_default', $data);
    }

    public function store(Request $req){

        $this->validate($req,[
            "id_ky" => "required",
            "id_periode_invest" => "required",
            "id_bentuk_invest" => "required",
            "persen_saham" => "required",
        ]);

        $model = new P();
        $model->id_ky = $req->id_ky;
        $model->id_periode_invest = $req->id_periode_invest;
        $model->id_bentuk_invest = $req->id_bentuk_invest;
        $model->persen_saham = $req->persen_saham;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan =$this->id_karyawan;

        if($model->save()){
            return redirect('Pelaku-Investasi')->with('message_success','Anda telah menambahkan pelaksana baru');
        }else{
            return redirect('Pelaku-Investasi')->with('message_fail','Maaf, data pelaksana baru tidak tersimpan');
        }
    }

    public function edit($id){
        if(empty($model = P::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
          "id_ky" => "required",
          "id_periode_invest" => "required",
          "id_bentuk_invest" => "required",
          "persen_saham" => "required",
          "id" => "required"
        ]);

        $model = P::find($req->id);
        $model->id_ky = $req->id_ky;
        $model->id_periode_invest = $req->id_periode_invest;
        $model->id_bentuk_invest = $req->id_bentuk_invest;
        $model->persen_saham = $req->persen_saham;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan =$this->id_karyawan;
        if($model->save()){
            return redirect('Pelaku-Investasi')->with('message_success','Anda telah mengubah pelaksana');
        }else{
            return redirect('Pelaku-Investasi')->with('message_fail','Maaf, data pelaksana tidak terubah');
        }
    }

    public function delete(Request $req, $id){
        $model = P::find($id);
        if($model->delete()){
            return redirect('Pelaku-Investasi')->with('message_success','Anda telah menghapus pelaksana');
        }else{
            return redirect('Pelaku-Investasi')->with('message_fail','Maaf, data pelaksana tidak terapus');
        }
    }
}
