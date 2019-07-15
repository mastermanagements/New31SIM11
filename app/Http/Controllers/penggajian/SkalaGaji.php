<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\KlasifikasiGaji as KG;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;
use App\Model\Penggajian\GradeGaji as gg;
class SkalaGaji extends Controller
{
    //
    private $id_karyawan;
    private $id_perusahaan;

    public function __construct()
    {
        $this->middleware(function($req, $next)
        {
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
        $data =[
            'klasifikasiGaji'=> KG::all()->where('id_perusahaan', $this->id_perusahaan),
            'jabatan'=> jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
            'grader'=> gg::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.SkalaGaji.page_default', $data);
    }
}
