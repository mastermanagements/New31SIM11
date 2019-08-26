<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\SkalaTunjangan as ST;

class SkalaTunjangan extends Controller
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
           'id_jabatan'=> 'required',
           'id_item_tunjangan'=> 'required',
           'besar_tunjangan'=> 'required',
        ]);

        $model = new ST(array_merge($req->all(),['id_perusahaan'=>$this->id_perusahaan,'id_karyawan'=>$this->id_karyawan]));
        if($model->save()){
            return redirect('Skala-tunjangan')->with('message_success', 'Anda telah menambahkan skala tunjagan baru');
        }else{
            return redirect('detail-daftar-tunjangan')->with('message_fail', 'Maaf, data skala tunjangan tidak dapat disimpan');
        }
    }

    public function edit($id){
        if(empty($model = ST::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'id_jabatan'=> 'required',
            'id_item_tunjangan'=> 'required',
            'besar_tunjangan'=> 'required',
            'id'=> 'required',
        ]);

        $model = ST::find($req->id)->update(array_merge($req->all(),['id_perusahaan'=>$this->id_perusahaan,'id_karyawan'=>$this->id_karyawan]));
        if($model){
            return redirect('Skala-tunjangan')->with('message_success', 'Anda telah mengubah skala tunjagan baru');
        }else{
            return redirect('detail-daftar-tunjangan')->with('message_fail', 'Maaf, data skala tunjangan tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id){
        $model = ST::find($id);
        if($model->delete()){
            return redirect('Skala-tunjangan')->with('message_success', 'Anda telah menghapus skala tunjagan baru');
        }else{
            return redirect('detail-daftar-tunjangan')->with('message_fail', 'Maaf, data skala tunjangan tidak dapat dihapus');
        }
    }

    public function statusOn(Request $req, $id){
        $model = ST::find($req->id);
        $model->status_tunjangan= '1';
        if($model->save()){
            return response()->json(array('message_success','Status telah diubah'));
        }
    }
    public function statusOff(Request $req, $id){
        $model = ST::find($req->id);
        $model->status_tunjangan= '0';
        if($model->save()){
            return response()->json(array('message_success','Status telah diubah'));
        }
    }

}
