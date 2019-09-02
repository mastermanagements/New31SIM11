<?php

namespace App\Http\Controllers\keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_sim\K_master_akun as kmA;
use App\Model\Keuangan\Akun as akun_master;


class Akun extends Controller
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

    public function index()
    {
        $data = [
          'master_akun'=>kmA::all()
        ];
        return view('user.keuangan.section.akun.page_default', $data);
    }

    public function store_akun_ukm(Request $req){
        $this->validate($req,[
            "id_akun_master"=> 'required'
        ]);

        $data_master_akun = kmA::find($req->id_akun_master);
        $model = akun_master::updateOrCreate(
            ['id_m_akun'=> $data_master_akun->id, 'id_perusahaan'=>$this->id_perusahaan, 'id_karyawan'=> $this->id_karyawan],
            ['kode_akun'=>$data_master_akun->kode_m_akun, 'nm_akun'=> $data_master_akun->nm_m_akun]
        );

        if($model->save()){
            $data=[
                'message'=> 'Berhasil diproses'
            ];
            return response()->json($data);
        }else{
            $data=[
                'message'=> 'Berhasil gagal diproses'
            ];
            return response()->json($data);
        }

    }

    public function delete_akun_ukm(Request $req){
        $this->validate($req,[
            "id_akun_master"=> 'required'
        ]);
         $model = akun_master::where('id',$req->id_akun_master)->where('id_perusahaan', $this->id_perusahaan)->first();
        if($model->delete()){
            $data=[
                'message'=> 'Berhasil diproses'
            ];
            return response()->json($data);
        }else{
            $data=[
                'message'=> 'Berhasil gagal diproses'
            ];
            return response()->json($data);
        }

    }
}
