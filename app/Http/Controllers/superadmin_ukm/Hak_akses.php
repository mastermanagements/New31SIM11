<?php

namespace App\Http\Controllers\Superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;
use App\Model\Superadmin_sim\U_master_menu as menu;
use Session;

class Hak_akses extends Controller
{
    //

    private $id_superadmin;

    public function __construct(){
        $this->middleware(function ($req, $next){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('login-page')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_superadmin = Session::get('id_superadmin_ukm');
            Session::put('main_menu','pengaturan_awal-pengguna_karyawan');
            return $next($req);
        });
    }

    public function daftar_hak_akses($id)
    {
        if(empty($data_karyawan=karyawan::where('id',$id)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'content_menu'=>"daftar-perusahaan",
            'karyawan'=> $data_karyawan,
            'menu'=> menu::all(),
        ];
        return view('user.superadmin_ukm.master.section.menu_karyawan.menu_create_page', $data_pass);
    }
}
