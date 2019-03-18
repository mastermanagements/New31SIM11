<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_menu_ukm as menu;
use App\Model\Superadmin_ukm\U_submenu_ukm as s_ukm_menu;
use App\Model\Superadmin_ukm\K_Investor as investor;
use App\Model\Superadmin_ukm\U_menu_investor as menu_investor;

use Session;
class Hak_akses_investor extends Controller
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
        if(empty($data_investor=investor::where('id',$id)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'content_menu'=>"daftar-perusahaan",
            'investor'=> $data_investor,
            'menu'=> menu::all()->where('id_perusahaan', $data_investor->id_perusahaan),
             'daftar_menu_investor' => menu_investor::where('id_investor', $data_investor->id)->get()
        ];
        return view('user.superadmin_ukm.master.section.menu_investor.menu_create_page', $data_pass);
    }

    public function store_menu(Request $req,$id)
    {
        if(empty($data_investor=investor::where('id',$id)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
            return abort(404);
        }

        $id_master_submenu = $req->id_master_submenu;
        $id_perusahaan = $data_investor->id_perusahaan;
        $model_sub_menu_ukm= s_ukm_menu::where('id_master_submenu', $id_master_submenu)->where('id_perusahaan', $id_perusahaan)->first();
        $id_menu_ukm = $model_sub_menu_ukm->id_menu_ukm;
        $id_sub_menu_ukm = $model_sub_menu_ukm->id;
        $id_investor = $data_investor->id;
        $id_user_ukm = $this->id_superadmin;


        $model_menu_investor = menu_investor::firstOrCreate([
            'id_submenu_ukm' =>$id_sub_menu_ukm,
            'id_perusahaan'=>$id_perusahaan,
            'id_investor'=>$id_investor,
            'id_menu_ukm'=>$id_menu_ukm,
            'id_user_ukm'=>$id_user_ukm
        ]);

        if($model_menu_investor->save())
        {
            $response = [
                'status'=> 'success',
                'message'=> 'Anda memperbolehkan investor membuka halaman ini'
            ];
            return response()->json($response);
        }

        $response = [
            'status'=> 'failed',
            'message'=> 'Terjadi Kesalahan, Silahkan lakukan ulang'
        ];
        return response()->json($response);

    }

    public function delete_menu(Request $req, $id)
    {
        if(empty($data_investor=investor::where('id',$id)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
            return abort(404);
        }
        $id_master_submenu = $req->id_master_submenu;
        $id_perusahaan = $data_investor->id_perusahaan;
        $model_sub_menu_ukm= s_ukm_menu::where('id_master_submenu', $id_master_submenu)->where('id_perusahaan', $id_perusahaan)->first();
        $id_sub_menu_ukm = $model_sub_menu_ukm->id;
        $model_menu_karyawan = menu_investor::where('id_submenu_ukm',$id_sub_menu_ukm)->first();
        if($model_menu_karyawan->delete())
        {
            $response = [
                'status'=> 'success',
                'message'=> 'Anda sudah mengtidak perbolehkan investor membuka halaman ini'
            ];
            return response()->json($response);
        }

        $response = [
            'status'=> 'failed',
            'message'=> 'Terjadi Kesalahan, Silahkan lakukan ulang'
        ];
        return response()->json($response);

    }
}
