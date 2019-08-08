<?php

namespace App\Http\Controllers\investor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Investor\PeriodeInvestasi as PI;
use Session;
use App\Investasi\I_data_investor as idi;
use App\Model\Investor\JualSahamInvestor as JSI;

class JualSahamInvestor extends Controller
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
        Session::put('menu-jual-saham','saham-investor');
        $data = [
            'periode_inves'=> PI::all()->where('id_perusahaan'),
            'investor' =>idi::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.investor.section.JualSaham.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
          "tgl_jual_s" => "required",
          "id_periode_invest" => "required",
          "id_investor_penjual" => "required",
          "lembar_saham_penjual" => "required",
          "jumlah_dijual" => "required",
          "id_investor_pembeli" => "required"
        ]);
        $data_req = $req->except(['id','']);
        dd($data_req);
        $model = new JSI();


    }
}
