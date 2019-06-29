<?php

namespace App\Http\Controllers\keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Keuangan\RencanaPendBarang as RPB;
use App\Model\Keuangan\RencanaPendJasa as RPJ;
use  Session;

class RAB extends Controller
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
        $data_rab = [
            'data_rpb' => RPB::all()->where('id_perusahaan', $this->id_perusahaan),
			'data_rpj' => RPB::where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.keuangan.section.rab.page_default', $data_rab);
    }
}
