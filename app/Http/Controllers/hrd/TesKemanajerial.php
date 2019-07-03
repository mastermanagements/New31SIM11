<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as ky;
use App\Model\Hrd\H_kompetensi_manajerial as hkm;
use App\Model\Hrd\H_item_kmanajerial as him;

class TesKemanajerial extends Controller
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

    public function index(){
        $data = [
            'ky'=>ky::where('id_perusahaan', $this->id_perusahaan)->paginate(15),
            'hkm' =>  hkm::all()->where('id_perusahaan', $this->id_perusahaan),
            'him'=> him::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.TesKemanajerialan.page_default', $data);
    }

    public function store(Request $req){
        dd($req->all());
    }

}
