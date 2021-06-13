<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\JobDecs as jobdesc;
use App\Model\Hrd\H_Jabatan_ky as jabatan_karyawan;
//use App\Model\Karyawan\TargetBulanan as TB;

use Session;

class AgendaHarian extends Controller
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
        $data = [
            'data_jobdesc'=> jobdesc::all()->where('id_perusahaan', $this->id_perusahaan),
			'jabatan_karyawan'=> jabatan_karyawan::all()->where('id_ky', $this->id_karyawan)->where('id_perusahaan', $this->id_perusahaan)->where('status_jabatan','aktif')
			
			//'data_target_bulanan'=> TB::all()->where('id_perusahaan', $this->id_perusahaan)
			
        ];
		//dd($data['data_jobdesc']);
        return view('user.administrasi.section.AgendaHarian.page_default', $data);
    }
	
}
