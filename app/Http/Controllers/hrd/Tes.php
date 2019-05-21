<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_loker as loker;

class Tes extends Controller
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

    public function psikotes()
    {
        $data = [
            'loker'=> loker::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at', 'desc')->paginate(15)
        ];
        Session::put('menu_tes', 'psikotes');
        return view('user.hrd.section.tes.page_default', $data);
    }

    public function keahlian(){
        Session::put('menu_tes', 'keahlian');
        return view('user.hrd.section.tes.page_default');
    }

    public function wawancara(){
        Session::put('menu_tes', 'wawancara');
        return view('user.hrd.section.tes.page_default');
    }
}
