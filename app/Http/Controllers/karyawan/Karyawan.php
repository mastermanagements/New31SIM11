<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\H_karyawan as karyawans;
use App\Model\Hrd\H_alamat_asal as asal;
use App\Model\Hrd\H_alamat_sekarang as sekarang;
use App\Model\Superadmin_sim\U_provinsi as provinsi;
use Session;

class Karyawan extends Controller
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
        $data =[
            'data_karyawan' => karyawans::where('id', $this->id_karyawan)->where('id_perusahaan', $this->id_perusahaan)->first(),
            'provinsi'=> provinsi::all()
        ];
        return view('user.karyawan.section.Profil.page_default', $data);
    }

    public function data_pendidikan()
    {
        if(empty($data_karyawan = karyawans::findOrfail($this->id_karyawan))){
            return abort(404);
        }
        $data_pass = [
            'data' => $data_karyawan
        ];
        return response()->json($data_pass);
    }

    public function proses_pendidikan(Request $req)
    {
        $pend_akhir = $req->pend_akhir;
        $program_studi = $req->program_studi;
        $pt = $req->pt;

        $model = karyawans::findOrfail($this->id_karyawan);
        $model->pend_akhir = $pend_akhir;
        $model->program_studi = $program_studi;
        $model->pt = $pt;

        if($model->save()){
            $data = [
                'message'=> 'Pendidikan baru saja diubah',
                'status'=> true
            ];
            return response()->json($data);
        }else{
            $data = [
                'message'=> 'Telah terjadi kesalahan',
                'status'=> false
            ];
            return response()->json($data);
        }
    }

    public function data_alamat()
    {
        if(empty($data_alamat = karyawans::where('id',$this->id_karyawan)->first()->getAlamatAsal)){
            return abort(404);
        }
        $data_pass = [
            'data' => $data_alamat
        ];
        return response()->json($data_pass);
    }

    public function store_alamat(Request $req)
    {
        $this->validate($req,[
            'alamat_asal' => 'required',
            'id_prov' =>' required',
            'id_kab' =>' required'
        ]);

        $alamat_asal = $req->alamat_asal;
        $id_prov = $req->id_prov;
        $id_kab = $req->id_kab;

        $model_asal = asal::updateOrCreate(['id_ky'=> $this->id_karyawan, 'id_perusahaan'=> $this->id_perusahaan],
            ['alamat_asal'=> $alamat_asal, 'id_prov'=> $id_prov,'id_kab'=> $id_kab,'id_karyawan'=> $this->id_karyawan]);
        if($model_asal->save())
        {
            $feedback = [
                'message'=>'Alamat telah diubah',
                'status'=> true
            ];
            return response()->json($feedback);
        }else{
            $feedback = [
                'message'=>'Terjadi kesalahan',
                'status'=> false
            ];
            return response()->json($feedback);
        }
    }

    public function data_alamat_sek()
    {
        if(empty($data_alamat = karyawans::where('id',$this->id_karyawan)->first()->getAlamatSek)){
            return abort(404);
        }
        $data_pass = [
            'data' => $data_alamat
        ];
        return response()->json($data_pass);
    }

    public function store_alamat_sek(Request $req)
    {
        $this->validate($req,[
            'alamat_asal' => 'required',
            'id_prov' =>' required',
            'id_kab' =>' required'
        ]);

        $alamat_asal = $req->alamat_asal;
        $id_prov = $req->id_prov;
        $id_kab = $req->id_kab;

        $model_asal = sekarang::updateOrCreate(['id_ky'=> $this->id_karyawan, 'id_perusahaan'=> $this->id_perusahaan],
            ['alamat_sek'=> $alamat_asal, 'id_prov'=> $id_prov,'id_kab'=> $id_kab,'id_karyawan'=> $this->id_karyawan]);
        if($model_asal->save())
        {
            $feedback = [
                'message'=>'Alamat telah diubah',
                'status'=> true
            ];
            return response()->json($feedback);
        }else{
            $feedback = [
                'message'=>'Terjadi kesalahan',
                'status'=> false
            ];
            return response()->json($feedback);
        }
    }
}
