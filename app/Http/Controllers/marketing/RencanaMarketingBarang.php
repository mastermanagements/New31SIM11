<?php

namespace App\Http\Controllers\marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use app\Model\Marketing\RencanaMarketingBarang as rencana_marketing_brg;
use App\Model\Keuangan\RAB as rab;
use App\Model\Keuangan\RencanaPendBarang as rencana_pend_brg;
use App\Model\Keuangan\RincianPendBarang as rincian_pend_brg;
use Session;

class RencanaMarketingBarang extends Controller
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
		'data_rab'=> TJP::all()->where('id_perusahaan',$this->id_perusahaan),
		'data_rencana_pb'=> TT::all()->where('id_perusahaan', $this->id_perusahaan),
		'data_rincian_pb'=> TB::all()->where('id_perusahaan', $this->id_perusahaan),
		'bagian_p'=>Bagian::all()->where('id_perusahaan', $this->id_perusahaan),
		'divisi_p'=>Divisi::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
		//dd($data_pass['data_tjp']);
        return view('user.marketing.section.RencanaMarketingBarang.page_default', $data_pass);
		
    }
}
