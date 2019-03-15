<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\U_usaha as usaha;
use App\Model\Superadmin_sim\U_master_menu as menu;
use App\Model\Superadmin_sim\U_master_sub_menu as s_menu;

use App\Model\Superadmin_ukm\U_menu_ukm as ukm_menu;
use App\Model\Superadmin_ukm\U_submenu_ukm as s_ukm_menu;

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
            'menu_perusahaan'=>  s_ukm_menu::all()->where('id_perusahaan', $id)
        ];
        return view('user.superadmin_ukm.master.section.menu_perusahaan.menu_create_page', $data_pass);
    }


    public function store_menu(Request $req)
    {
        $this->validate($req,[
           'sub_menu_id' => 'required',
            'id_usaha' => 'required'
        ]);

        $pk_sub_menu = $req->sub_menu_id;
        $id_perusahaan = $req->id_usaha;
        $sub_master_menu_mode_l = s_menu::findOrFail($pk_sub_menu);
        $master_menu_model = menu::findOrFail($sub_master_menu_mode_l->id_master_menu);
        $model_menu_ukm=ukm_menu::firstOrCreate(['id_master_menu'=>$master_menu_model->id,'id_perusahaan'=> $id_perusahaan]);
        if($model_menu_ukm->save())
        {
            $master_SubMenu_model = new s_ukm_menu;
            $master_SubMenu_model->id_menu_ukm = $model_menu_ukm->id;
            $master_SubMenu_model->id_master_submenu = $sub_master_menu_mode_l->id;
            $master_SubMenu_model->id_perusahaan = $id_perusahaan;

            if($master_SubMenu_model->save())
            {
                $response = [
                  'Message'=> 'Menu berhasil diaktifkan'
                ];

                return response()->json($response);
            }
        }

        return response()->json(array('Message'=> 'Terjadi Kesalahan..!'));
    }

    public function delete_menu(Request $req)
    {
        $this->validate($req,[
            'sub_menu_id' => 'required',
            'id_usaha' => 'required'
        ]);

        $model = s_ukm_menu::where('id_master_submenu', $req->sub_menu_id)->where('id_perusahaan', $req->id_usaha)->first();
        if($model->delete())
        {
            return response()->json(array('Message'=> 'Anda Telah Menon Aktifkan menu ini..!'));
        }
        return response()->json(array('Message'=> 'Terjadi Kesalahan..!'));
    }
}
