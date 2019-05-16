<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_loker as lokers;

class SeleksiBerkas extends Controller
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

    public function index(){
        $data = [
            'data_loker'=> lokers::where('id_perusahaan', $this->id_perusahaan)->paginate()
        ];
        return view('user.hrd.section.seleksiberkas.page_default', $data);
    }

    public function show($id)
    {
        if(empty($model = lokers::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()->lamaran_pek)){
            return abort(404);
        }
        $data = [
            'data_pelamar'=>$model
        ];
        return view('user.hrd.section.seleksiberkas.page_detail', $data);
    }

    public function show_peserta($id_peserta)
    {

    }
}
