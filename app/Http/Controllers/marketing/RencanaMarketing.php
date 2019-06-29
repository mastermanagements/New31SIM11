<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\marketing\RencanaMarketingBarang as rencana_marketing_brg;
use App\Model\marketing\RencanaMarketingJasa as rencana_marketing_jasa;
use App\Model\keuangan\RincianPendBarang as rincian_pend_brg;

use Session;

class RencanaMarketing extends Controller
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
        $data_pass= [
		'data_rencana_mb'=> rencana_marketing_brg::all()->where('id_perusahaan',$this->id_perusahaan),
		
        ];
		//dd($data_pass['data_rab']);
        return view('user.marketing.section.RencanaMarketing.page_default', $data_pass);
		
    }
}
