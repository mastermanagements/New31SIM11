<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_setting_cuti as HSC;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;
use App\Model\Hrd\Cuti as h_cuti;


class Cuti extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
    private $pengurangan_cuti =[
        '0'=> 'Cuti bersama tidak mengurangi cuti tahunan',
        '1'=> 'Cuti bersama mengurangi cuti tahunan',
    ];
    private $akumulasi_cuti =[
        '0'=> 'Sisa cuti tahunan tidak di akumulasikan ke thn berikutnya',
        '1'=> 'Sisa cuti tahunan di akumulasikan ke thn berikutnya',
    ];
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

    public function index()
    {
        $data =[
            'pengaturan_Cuti'=>HSC::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_cuti'=>h_cuti::all()->where('id_perusahaan', $this->id_perusahaan),
            'pengurangan_cuti'=>$this->pengurangan_cuti,
            'akumulasi_cuti'=>$this->akumulasi_cuti,
        ];
        return view('user.hrd.section.cuti.page_default', $data);
    }

    public function create()
    {
        $data = [
            'data_karyawan'=> karyawan::all()->where('id_perusahaan', $this->id_perusahaan),
            'pengaturan_cuti'=> HSC::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.hrd.section.cuti.cuti.page_create', $data);
    }

    public function store(Request $request){
        $this->validate($request,[
            'id_ky'=>'required',
            'periode'=>'required',
            'id_setting_cuti'=>'required',
            'max_suci'=>'required',
        ]);

        $id_ky = $request->id_ky;
        $periode = $request->periode;
        $id_setting_cuti = $request->id_setting_cuti;
        $max_suci = $request->max_suci;

        $model = new h_cuti();
        $model->id_ky = $id_ky;
        $model->periode = $periode;
        $model->id_setting_cuti = $id_setting_cuti;
        $model->max_suci = $max_suci;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            Session::get('menu_cuti','daftar_cuti');
            return redirect('Cuti')->with('message_success','Anda telah menambah data cuti baru');
        }else{
            Session::get('menu_cuti','daftar_cuti');
            return redirect('Cuti')->with('message_success','gagal menambahkan data cuti baru');
        }
    }

    public function edit($id)
    {
        if(empty($model =  h_cuti::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
            'data_cuti'=> $model,
            'data_karyawan'=> karyawan::all()->where('id_perusahaan', $this->id_perusahaan),
            'pengaturan_cuti'=> HSC::all()->where('id_perusahaan', $this->id_perusahaan),
        ];
        return view('user.hrd.section.cuti.cuti.page_edit', $data);
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'id_ky'=>'required',
            'periode'=>'required',
            'id_setting_cuti'=>'required',
            'max_suci'=>'required',
        ]);

        $id_ky = $request->id_ky;
        $periode = $request->periode;
        $id_setting_cuti = $request->id_setting_cuti;
        $max_suci = $request->max_suci;

        $model = h_cuti::find($id);
        $model->id_ky = $id_ky;
        $model->periode = $periode;
        $model->id_setting_cuti = $id_setting_cuti;
        $model->max_suci = $max_suci;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            Session::get('menu_cuti','daftar_cuti');
            return redirect('Cuti')->with('message_success','Anda telah mengubah data cuti baru');
        }else{
            Session::get('menu_cuti','daftar_cuti');
            return redirect('Cuti')->with('message_success','gagal mengubah data cuti baru');
        }
    }

    public function delete(Request $request, $id){

        $model = h_cuti::find($id);

        if($model->delete())
        {
            Session::get('menu_cuti','daftar_cuti');
            return redirect('Cuti')->with('message_success','Anda telah menghapus data cuti baru');
        }else{
            Session::get('menu_cuti','daftar_cuti');
            return redirect('Cuti')->with('message_success','gagal menghapus data cuti baru');
        }
    }
}
