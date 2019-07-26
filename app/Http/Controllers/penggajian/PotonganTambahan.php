<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\G_potongan_tambahan as gpt;

class PotonganTambahan extends Controller
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
           'keterangan'=> 'required',
           'jumlah_potongan'=> 'required',
           'id_ky'=> 'required',
           'id_slip'=> 'required',
        ]);
        $dataReq =$req->except('_token');

        $model = new gpt(array_merge($dataReq,['id_perusahaan'=>$this->id_perusahaan,'id_karyawan'=>$this->id_karyawan]));
        if($model->save()){
            return redirect('item-gaji/'.$model->id_slip)->with('message_success','Anda telah menambahkan potongan ');
        }else{
            return redirect('item-gaji/'.$model->id_slip)->with('message_fail','Maaf, potongan tidak tersimpan');
        }
    }


    public function delete(Request $req, $id){
       $model = gpt::find($id);
        if($model->delete()){
            return redirect('item-gaji/'.$model->id_slip)->with('message_success','Anda telah menghapus potongan ');
        }else{
            return redirect('item-gaji/'.$model->id_slip)->with('message_fail','Maaf, potongan tidak terhapus');
        }
    }
}
