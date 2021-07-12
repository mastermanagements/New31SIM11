<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_loker as lokers;
use App\Model\Hrd\H_seleksi_berkas as selek_berkas;
use App\Model\Hrd\H_lamaran_pek as lamaran_pek ;

class SeleksiBerkas extends Controller
{
    //
    private $id_karyawan;
    private $id_perusahaan;
    private $hasil =  [
        0=> 'Tidak Lulus',
        1=> 'Lulus'
    ];

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
        $data = [
            'data_loker'=> lokers::where('id_perusahaan', $this->id_perusahaan)->paginate()
        ];
        return view('user.hrd.section.seleksiberkas.page_default', $data);
    }

    public function show($id)
    {
        if(empty($model = lokers::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()->lamaran_pek)){
            return abort(404);
        }
        $data = [
            'data_pelamar'=>$model
        ];
        return view('user.hrd.section.seleksiberkas.page_detail', $data);
    }

    public function show_peserta($id_peserta)
    {
        if(empty($model = lamaran_pek::where('id',$id_peserta)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
          'data_peserta'=> $model,
          'hasil'=> $this->hasil
        ];

        return view('user.hrd.section.seleksiberkas.page_create', $data);
    }

    public function save(Request $request, $id)
    {
        $this->validate($request,[
            'hasil' => 'required',
            'ket'=> 'required'
        ]);

        $hasil = $request->hasil;
        $ket = $request->ket;

        $model = selek_berkas::updateOrCreate(['id_lamaran_p'=> $id,'id_perusahaan'=> $this->id_perusahaan,'id_karyawan'=>$this->id_karyawan],[
            'hasil'=> $hasil, 'ket'=>$ket,
        ]);

        if($model->save()){
            return redirect('daftar-pelamar/'.$model->pelamar->id_loker)->with('message_success','Anda telah menambah data seleksi berkas baru');
        }
        return redirect('Seleksi')->with('message_fail','telah terjadi kesalahan, silahkan coba lagi');
    }
}
