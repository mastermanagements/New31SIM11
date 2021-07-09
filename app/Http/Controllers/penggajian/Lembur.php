<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\G_lembur as gl;

class Lembur extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;

    public function __construct()
    {
        $this->middleware(function($req, $next){
            if(empty(Session::get('id_karyawan')) && empty(Session::get('id_perusahaan_karyawan')))
            {
                Session::flush();
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function store(Request $req){
        $data_req = $req->except(['_token','id_lembur']);
        $model = gl::updateOrCreate(
            ['id_ky'=> $data_req['id_ky'],'id_slip'=>$data_req['id_slip'], 'id_perusahaan'=>$this->id_perusahaan,'id_karyawan'=> $this->id_karyawan],
            ['jum_lembur'=>$data_req['jum_lembur'],'jum_besaran_lembur'=> $data_req['jum_besaran_lembur']]
        );
        if($model->save()){
            return redirect('item-gaji/'.$model->id_slip)->with('message_success','Lembur telah ditambahkan');
        }else{
            return redirect('item-gaji/'.$model->id_slip)->with('message_fail','Lembur telah gagal ditambahkan');
        }
    }

    public function delete(Request $req, $id){
        $model = gl::find($id);
        if($model->delete()){
            return redirect('item-gaji/'.$model->id_slip)->with('message_success','Lembur telah dihapus');
        }else{
            return redirect('item-gaji/'.$model->id_slip)->with('message_fail','Lembur telah gagal dihapus');
        }
    }
}
