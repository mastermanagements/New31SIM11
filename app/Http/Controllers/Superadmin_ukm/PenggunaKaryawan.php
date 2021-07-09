<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;
use App\Model\Superadmin_ukm\U_usaha as usaha;
class PenggunaKaryawan extends Controller
{
    //

    private $id_superadmin;

    public function __construct(){
        $this->middleware(function ($req, $next){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('/')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_superadmin = Session::get('id_superadmin_ukm');
            Session::put('main_menu','pengaturan_awal-pengguna_karyawan');
            return $next($req);
        });
    }



    public function karyawan()
    {
        $data_pass = [
            'content_menu'=>"karyawan",
            'usaha'=> usaha::where('id_user_ukm', $this->id_superadmin)->paginate(6)
        ];
        return view('user.superadmin_ukm.master.section.pengguna_karyawan.page_default', $data_pass);
    }


}
