<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Administrasi\JenisArsip as jenis_arsip;

class JenisArsip extends Controller
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

    public function index()
    {
       return "Jenis Arsip";
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'jenis_arsip' => 'required',
        ]);

        $jenis_arsip = $req->jenis_arsip;

        $model = new jenis_arsip;
        $model->jenis_arsip = $jenis_arsip;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save())
        {
            return redirect('Surat')->with('message_success','Anda baru saja menambahkan jenis arsip');
        }else
        {
            return redirect('Surat')->with('message_fail','Maaf, terjadi kesalahan. silahkan coba lagi');
        }
    }

    public function edit($id)
    {
        if(empty($data_jenis_arsip = jenis_arsip::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
          'data' => $data_jenis_arsip
        ];

        return response()->json($data);
    }

    public function update(Request $req)
    {
       // dd($req->all());
        $this->validate($req,[
            'jenis_arsip_ubah' => 'required',
            'id'=> 'required'
        ]);

        $jenis_arsip = $req->jenis_arsip_ubah;

        $model = jenis_arsip::find($req->id);
        $model->jenis_arsip = $jenis_arsip;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save())
        {
            return redirect('Surat')->with('message_success','Anda baru saja mengubah jenis arsip');
        }else
        {
            return redirect('Surat')->with('message_fail','Maaf, terjadi kesalahan. silahkan coba lagi');
        }
    }

    public function delete(Request $req)
    {
        $this->validate($req,[
            'id'=> 'required'
        ]);

        $model = jenis_arsip::find($req->id);
        if($model->delete())
        {
            return redirect('Surat')->with('message_success','Anda baru saja menghapus jenis arsip');
        }else
        {
            return redirect('Surat')->with('message_fail','Maaf, terjadi kesalahan. silahkan coba lagi');
        }
    }
}
