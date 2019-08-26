<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\KlasifikasiGaji as Kg;
class KlasifikasiGaji extends Controller
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

    public function store(Request $req){
        $this->validate($req,[
            'klasifikasi'=> 'required',
       ]);

        $model = new Kg();
        $model->klasifikas = $req->klasifikasi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Skala-Gaji')->with('message_success','Anda telah menambahkan klasifikasi gaji baru');
        }else{
            return redirect('Skala-Gaji')->with('message_fail','Maaf, Klasifikasi gaji tidak dapat disimpan');
        }
    }

    public function edit($id){
        if(empty($model = Kg::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){

        $this->validate($req,[
            'klasifikasi'=> 'required',
            'id'=> 'required',
        ]);

        $model = Kg::find($req->id);
        $model->klasifikas = $req->klasifikasi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Skala-Gaji')->with('message_success','Anda telah mengubah klasifikasi gaji baru');
        }else{
            return redirect('Skala-Gaji')->with('message_fail','Maaf, Klasifikasi gaji tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id){

        $model = Kg::find($id);
        if($model->delete()){
            return redirect('Skala-Gaji')->with('message_success','Anda telah mengubah klasifikasi gaji baru');
        }else{
            return redirect('Skala-Gaji')->with('message_fail','Maaf, Klasifikasi gaji tidak dapat diubah');
        }
    }
}
