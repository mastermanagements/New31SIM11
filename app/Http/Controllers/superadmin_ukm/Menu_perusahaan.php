<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\U_usaha as usaha;
use App\Model\Superadmin_sim\U_master_menu as menu;


class Menu_perusahaan extends Controller
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
            Session::put('main_menu','pengaturan_awal-menu_perusahaan');
            return $next($req);
        });
    }

    public function daftar_perusahaan()
    {
        $data_pass = [
            'content_menu'=>"daftar-perusahaan",
            'usaha'=> usaha::where('id_user_ukm', $this->id_superadmin)->paginate(6)
        ];
        return view('user.superadmin_ukm.master.section.menu_perusahaan.page_default', $data_pass);
    }

    public function daftar_menu($id)
    {
        if(empty($data_usaha=usaha::where('id',$id)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'content_menu'=>"daftar-perusahaan",
            'usaha'=> $data_usaha,
            'menu'=> menu::all(),
        ];
        return view('user.superadmin_ukm.master.section.menu_perusahaan.menu_create_page', $data_pass);
    }

}
