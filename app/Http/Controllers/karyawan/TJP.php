<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\TJP as TJP;

use Session;

class TJP extends Controller
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

    public function index()
    {
        $data_pass= [
          'data_tjp'=> TJP::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','asc')
        ];
        return view('user.karyawan.section.TJP.page_default', $data_pass);
    }

    
}
