<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\ItemTunjangan as IT;

class ItemTunjangan extends Controller
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
            'nm_tunjangan' => 'required'
        ]);

        $model = new IT();
        $model->nm_tunjangan = $req->nm_tunjangan;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save()){
           return redirect('item-tunjangan')->with('message_success','Anda telah menambahkan item tunjangan baru');
        }else{
            return redirect('item-tunjangan')->with('message_fail','Maaf, item tunjangan tidak dapat disimpan');
        }
    }

    public function edit($id){
        if(empty($model=IT::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'nm_tunjangan' => 'required',
            'id' => 'required'
        ]);

        $model = IT::find($req->id);
        $model->nm_tunjangan = $req->nm_tunjangan;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save()){
           return redirect('item-tunjangan')->with('message_success','Anda telah mengubah item tunjangan');
        }else{
            return redirect('item-tunjangan')->with('message_fail','Maaf, item tunjangan tidak dapat diubah');
        }
    }

    public function delete(Request $req, $id){

        $model = IT::find($id);
        if($model->delete()){
           return redirect('item-tunjangan')->with('message_success','Anda telah menghapus item tunjangan');
        }else{
            return redirect('item-tunjangan')->with('message_fail','Maaf, item tunjangan tidak dapat dihapus');
        }
    }
}
