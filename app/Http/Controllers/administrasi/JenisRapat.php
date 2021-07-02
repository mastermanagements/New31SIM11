<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Administrasi\JenisBrifing as jenis_brifing;
class JenisRapat extends Controller
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

    public function index(){
        $data_jenis_brifing = [
            'jenis_brifing'=>jenis_brifing::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.administrasi.section.Brifing.JenisBrifing.page_default', $data_jenis_brifing);
    }


    public function store(Request $req)
    {
        $this->validate($req, [
           'jenis_rapat' => 'required',
        ]);

        $jenis_rapat =$req->jenis_rapat;
        $model = new jenis_brifing;
        $model->jenis_rapat = $jenis_rapat;
        $model->id_perusahaan= $this->id_perusahaan;
        if($model->save())
        {
            return redirect('Pengaturan-rapat')->with('message_success','Anda telah menambahkan jenis rapat baru');
        }else{
            return redirect('Pengaturan-rapat')->with('message_fail','Maaf terjadi kesalahan, silahkan coba lagi');
        }
    }

    public function edit($id)
    {
        if(empty($dataJenisRapat = jenis_brifing::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($dataJenisRapat);
    }

    public function update(Request $req)
    {
         $this->validate($req, [
            'jenis_rapat_ubah' => 'required',
            'id' => 'required',
        ]);

        $jenis_rapat_ubah =$req->jenis_rapat_ubah;
        $id =$req->id;
        $model = jenis_brifing::find($id);
        $model->jenis_rapat = $jenis_rapat_ubah;
        $model->id_perusahaan= $this->id_perusahaan;
        if($model->save())
        {
            return redirect('Pengaturan-rapat')->with('message_success','Anda telah mengubah jenis rapat baru');
        }else{
            return redirect('Pengaturan-rapat')->with('message_fail','Maaf terjadi kesalahan, silahkan coba lagi');
        }
    }

    public function delete(Request $req, $id)
    {

        $model = jenis_brifing::find($id);
       if($model->delete())
        {
            return redirect('Pengaturan-rapat')->with('message_success','Anda telah menghapus jenis rapat');
        }else{
            return redirect('Pengaturan-rapat')->with('message_fail','Maaf terjadi kesalahan, silahkan coba lagi');
        }
    }
}
