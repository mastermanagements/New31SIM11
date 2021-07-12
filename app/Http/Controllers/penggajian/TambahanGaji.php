<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\G_tambahan_gaji as gtg;

class TambahanGaji extends Controller
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
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function store(Request $req){

        $this->validate($req,[
            'keterangan'=>'required',
            'jumlah_uang'=> 'required',
            'id_ky'=> 'required',
            'id_slip'=> 'required'
        ]);

        $data_req = $req->except('_token');
        $model = new gtg(array_merge($data_req,['id_perusahaan'=> $this->id_perusahaan,'id_karyawan'=>$this->id_karyawan]));
        if($model->save()){
            return redirect('item-gaji/'. $model->id_slip)->with('message_success','Anda telah menambahkan tambahkan pendappatan');
        }else{
            return redirect('item-gaji/'. $model->id_slip)->with('message_fail','Maaf, data tambahan pendapatan tidak dapat disimpan');
        }
    }

    public function delete(Request $req, $id){
        $model = gtg::find($id);
        if($model->delete()){
            return redirect('item-gaji/'. $model->id_slip)->with('message_success','Anda telah menghapus tambahkan pendappatan');
        }else{
            return redirect('item-gaji/'. $model->id_slip)->with('message_fail','Maaf, data menghapus pendapatan tidak dapat disimpan');
        }
    }

}
