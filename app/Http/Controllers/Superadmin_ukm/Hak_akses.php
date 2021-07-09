<?php

namespace App\Http\Controllers\Superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;

use App\Model\Superadmin_ukm\U_menu_ukm as menu;
use App\Model\Superadmin_ukm\U_submenu_ukm as s_ukm_menu;

use App\Model\Superadmin_ukm\U_menu_karyawan as menu_karyawan;

use Session;

class Hak_akses extends Controller
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

    public function daftar_hak_akses($id)
    {
        if(empty($data_karyawan=karyawan::where('id',$id)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'content_menu'=>"daftar-perusahaan",
            'karyawan'=> $data_karyawan,
            'menu'=> menu::all()->where('id_perusahaan', $data_karyawan->id_perusahaan),
            'daftar_menu_karyawan' => menu_karyawan::where('id_karyawan', $data_karyawan->id)->get()
        ];
        return view('user.superadmin_ukm.master.section.menu_karyawan.menu_create_page', $data_pass);
    }


    public function store_menu(Request $req, $id)
    {
        if(empty($data_karyawan=karyawan::where('id',$id)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
            return abort(404);
        }

        $id_master_submenu = $req->id_master_submenu;
        $id_perusahaan = $data_karyawan->id_perusahaan;
        $model_sub_menu_ukm= s_ukm_menu::where('id_master_submenu', $id_master_submenu)->where('id_perusahaan', $id_perusahaan)->first();
        $id_menu_ukm = $model_sub_menu_ukm->id_menu_ukm;
        $id_sub_menu_ukm = $model_sub_menu_ukm->id;
        $id_karyawan = $data_karyawan->id;
        $id_user_ukm = $this->id_superadmin;
		$urutan = $model_sub_menu_ukm->urutan;

        $model_menu_karyawan = menu_karyawan::firstOrCreate([
            'id_submenu_ukm' =>$id_sub_menu_ukm,
            'id_perusahaan'=>$id_perusahaan,
            'id_karyawan'=>$id_karyawan,
            'id_menu_ukm'=>$id_menu_ukm,
            'id_user_ukm'=>$id_user_ukm,
			'urutan'=>$urutan
        ]);

        if($model_menu_karyawan->save())
        {
            $response = [
                'status'=> 'success',
                'message'=> 'Anda memperbolehkan karyawan membuka halaman ini'
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
        if(empty($data_karyawan=karyawan::where('id',$id)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
            return abort(404);
        }
        $id_master_submenu = $req->id_master_submenu;
        $id_perusahaan = $data_karyawan->id_perusahaan;
        $model_sub_menu_ukm= s_ukm_menu::where('id_master_submenu', $id_master_submenu)->where('id_perusahaan', $id_perusahaan)->first();
        $id_sub_menu_ukm = $model_sub_menu_ukm->id;
        $model_menu_karyawan = menu_karyawan::where('id_submenu_ukm',$id_sub_menu_ukm)->first();
        if($model_menu_karyawan->delete())
        {
            $response = [
                'status'=> 'success',
                'message'=> 'Anda sudah mengtidak perbolehkan karyawan membuka halaman ini'
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
