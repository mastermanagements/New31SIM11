<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\JenisPemeliharaan as jenis_pemeliharaans;
use Session;

class JenisPemeliharaan extends Controller
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

    public function create()
    {
        return view('user.produksi.section.pemeliharaan.jenispemeliharaan.page_create');
    }

    public function store(Request $req)
    {
        $this->validate($req, [
           'jenis_pem'=> 'required'
        ]);

        $jenis_pem = $req->jenis_pem;
        $model = new jenis_pemeliharaans;
        $model->jenis_pem = $jenis_pem;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save())
        {
            return redirect('Pemeliharaan')->with('message_success', 'Anda telah menambahkan jenis pemeliharaan');
        }else{
            return redirect('Pemeliharaan')->with('message_fail', 'Maaf, telah terjadi kesalahan');
        }
    }

    public function edit($id)
    {
        if(empty($model = jenis_pemeliharaans::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data=[
            'data'=> $model
        ];
        return view('user.produksi.section.pemeliharaan.jenispemeliharaan.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'jenis_pem'=> 'required'
        ]);

        $jenis_pem = $req->jenis_pem;
        $model = jenis_pemeliharaans::find($id);
        $model->jenis_pem = $jenis_pem;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save())
        {
            return redirect('Pemeliharaan')->with('message_success', 'Anda telah mengubah jenis pemeliharaan');
        }else{
            return redirect('Pemeliharaan')->with('message_fail', 'Maaf, telah terjadi kesalahan');
        }
    }


    public function delete(Request $req, $id)
    {
        $model = jenis_pemeliharaans::find($id);
        if($model->delete())
        {
            return redirect('Pemeliharaan')->with('message_success', 'Anda telah menghapus jenis pemeliharaan');
        }else{
            return redirect('Pemeliharaan')->with('message_fail', 'Maaf, telah terjadi kesalahan');
        }
    }
}
