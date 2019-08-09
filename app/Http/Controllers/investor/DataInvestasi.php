<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Investor\PeriodeInvestasi as PI;
use App\Investasi\I_data_investor as investor;
use App\Model\Investor\BentukInvestor as BI;
use App\Model\Investor\DaftarInvestasi as DI;
use App\Traits\ProsesDaftarInvestasi as PDI;

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
        $trait_data_investasi = new PDI();
        if($trait_data_investasi->storeInvestasi($req, $this->id_con)){
            return redirect('Data-Investasi')->with('message_success','Anda telah menambahkan data investor');
        }else{
            return redirect('Data-Investasi')->with('message_fail','Maaf, data investor tidak tersimpan');
        }
    }

    public function edit($id){
        if(empty($model = DI::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            "id" => "required",
            "tgl_invest" => "required",
            "id_periode_invest" => "required",
            "id_investor" => "required",
            "jumlah_saham" => "required",
            "id_bentuk_invest" => "required",
        ]);
        $trait_data_investasi = new PDI();
        if($trait_data_investasi->update($req, $this->id_con)){
            return redirect('Data-Investasi')->with('message_success','Anda telah mengubah data investor');
        }else{
            return redirect('Data-Investasi')->with('message_fail','Maaf, data investor tidak terubah');
        }
    }

    public function delete(Request $req, $id){
        $model = DI::find($id);
        if($model->delete()){
            return redirect('Data-Investasi')->with('message_success','Anda telah menghapus data investor');
        }else{
            return redirect('Data-Investasi')->with('message_fail','Maaf, data investor tidak terhapus');
        }
    }



}
