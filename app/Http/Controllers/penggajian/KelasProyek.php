<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\G_kelas_proyek as Gkp;
class KelasProyek extends Controller
{
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


    public function store(Request $req){
        $this->validate($req,[
            'nm_kelas'=> 'required',
            'keterangan'=> 'required',
            'persen_besar_proyek'=> 'required',
        ]);

        $data_req = $req->except('_token');
        $model = new Gkp(
            array_merge($data_req, ['id_perusahaan'=>$this->id_perusahaan,'id_karyawan'=>$this->id_karyawan])
        );

        if($model->save()){
            return redirect('Kelas-proyek')->with('message_success','Anda telah menambahkan Kelas Proyek Baru');
        }else{
            return redirect('Kelas-proyek')->with('message_fail','Maaf, Kelas Proyek tidak dapat disimpan');
        }
    }

    public function edit($id){
        if(empty($model= Gkp::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'id'=> 'required',
            'nm_kelas'=> 'required',
            'keterangan'=> 'required',
            'persen_besar_proyek'=> 'required',
        ]);

        $data_req = $req->except('_token');
        $model = Gkp::find($req->id)->update(
            array_merge($data_req, ['id_perusahaan'=>$this->id_perusahaan,'id_karyawan'=>$this->id_karyawan])
        );

        if($model){
            return redirect('Kelas-proyek')->with('message_success','Anda telah mengubah Kelas Proyek Baru');
        }else{
            return redirect('Kelas-proyek')->with('message_fail','Maaf, Kelas Proyek tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = Gkp::find($id);
        if($model->delete()){
            return redirect('Kelas-proyek')->with('message_success','Anda telah menghapus Kelas Proyek Baru');
        }else{
            return redirect('Kelas-proyek')->with('message_fail','Maaf, Kelas Proyek tidak dapat hapus');
        }
    }
}
