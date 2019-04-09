<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\SPKKontrak as spk;
use App\Model\Administrasi\BApemeriksaan as bapem;
use Session;

class BApemeriksaan extends Controller
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

    public function form(Request $req)
    {
       if(empty($data_spk=spk::where('id', $req->id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }else{
           $data_bapem = bapem::all()->where('id_spk', $data_spk->id)->where('id_perusahaan', $this->id_perusahaan);
       }

        $data_pass = [
            'spk'=> $data_spk,
            'save'=> $req->callForm,
            'data_bapem'=> $data_bapem
        ];
         return view('user.administrasi.section.BApemeriksaan.page_default', $data_pass);
    }

    public function proses(Request $req)
    {
        $this->validate($req,[
            'isi_bapem'=> 'required',
            'id_spk'=> 'required'
        ]);

        $id_spk = $req->id_spk;
        $isi_bapem = $req->isi_bapem;

        if($req->hasFile('file_bapem'))
        {
            $file_bapem = $req->file_bapem;
            $name_files = uniqid().time().'.'.$file_bapem->getClientOriginalExtension();
            $file_bapem->move(public_path('fileBApem'), $name_files);
        }else{
            $name_files = "";
        }

        $model = new bapem;
        $model->id_spk= $id_spk;
        $model->isi_bapem= $isi_bapem;
        $model->scan_file= $name_files;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save())
        {
            return redirect('Ba-Pemeriksaan?id='.$id_spk)->with('message_success','Anda Baru saja menambahkan BAP');
        }else{
            return redirect('Ba-Pemeriksaan?id='.$id_spk)->with('message_fail','Terjadi Kesalahan, Silahkan coba lagi');
        }
    }

}
