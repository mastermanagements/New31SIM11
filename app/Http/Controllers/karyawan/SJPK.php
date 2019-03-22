<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\SJP as sjps;
use App\Model\Karyawan\Bagian as bagian;
use App\Model\Karyawan\Devisi as devisi;
use App\Model\Karyawan\SJPK as sjpks;

use Session;

class SJPK extends Controller
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

    public function index()
    {
        $data_pass= [
            'data_strategi'=> sjps::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate(12)
        ];
        return view('user.karyawan.section.SJPK.page_default', $data_pass);
    }

    public function create(Request $req)
    {
        $this->validate($req,[
           'sjp'=> 'required'
        ]);
        $data_pass = [
            'data_bagian' => bagian::all()->where('id_perusahaan', $this->id_perusahaan),
            'sjp'=>$req->sjp
        ];
        return view('user.karyawan.section.SJPK.page_create', $data_pass);
    }

    public function store(Request $req)
    {

        $this->validate($req,[
           'periode'=>'required',
            'id_divisi' => 'required',
            'isi_spjd' => 'required',
            'id_sjpk' => 'required'
        ]);

        $periode = $req->periode;
        $divisi = $req->id_divisi;
        $id_sjpk = $req->id_sjpk;
        $isi_spjd= $req->isi_spjd;

        if(empty($data_divisi = devisi::find($divisi))){
            return abort(404);
        }

        $model =sjpks::updateOrCreate(['id_bagian_p'=>$data_divisi->id_bagian_p,'id_divisi_p'=> $divisi, 'periode'=>$periode
            ,'id_sjpg'=>$id_sjpk,'id_perusahaan'=> $this->id_perusahaan
            ,'id_karyawan'=> $this->id_karyawan], ['isi_spjd'=> $isi_spjd]);

        if($model->save()){
            return redirect('Strategi-Jangka-Pendek')->with('message_sucess','Anda telah menambahkan strategi jangka panjang pada divisi : '.$model->getDivisi->nm_devisi);
        }else{
            return redirect('Strategi-Jangka-Pendek')->with('message_fail','Telah terjadi kesalahan, Isi dengan benar');
        }
    }

    public function edit(Request $req)
    {
        $this->validate($req,[
            'sjpk' => 'required'
        ]);
        if(empty($data_sjpk = sjpks::where('id',$req->sjpk)->where('id_perusahaan', $this->id_perusahaan)->first() ))
        {
            return abort(404);
        }
        $data_pass = [
            'data_bagian' => bagian::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_sjpk'=> $data_sjpk
        ];
        return view('user.karyawan.section.SJPK.page_edit', $data_pass);
    }

    public function update(Request $req, $id)
    {

        $this->validate($req,[
            'periode'=>'required',
            'id_divisi' => 'required',
            'isi_spjd' => 'required',
            'id_sjpk' => 'required'
        ]);

        $periode = $req->periode;
        $divisi = $req->id_divisi;
        $id_sjpk = $req->id_sjpk;
        $isi_spjd= $req->isi_spjd;

        if(empty($data_divisi = devisi::find($divisi))){
            return abort(404);
        }

        $model =sjpks::find($id);
        $model->id_sjpg = $id_sjpk;
        $model->id_bagian_p = $data_divisi->id_bagian_p;
        $model->id_divisi_p = $divisi;
        $model->periode = $periode;
        $model->isi_spjd = $isi_spjd;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('Strategi-Jangka-Pendek')->with('message_sucess','Anda telah mengubah strategi jangka panjang pada divisi : '.$model->getDivisi->nm_devisi);
        }else{
            return redirect('Strategi-Jangka-Pendek')->with('message_fail','Telah terjadi kesalahan, Isi dengan benar');
        }
    }

    public function delete($id)
    {
        if(empty($model =sjpks::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if($model->delete()){
            return redirect('Strategi-Jangka-Pendek')->with('message_sucess','Anda telah menghapus strategi jangka panjang pada divisi : '.$model->getDivisi->nm_devisi);
        }else{
            return redirect('Strategi-Jangka-Pendek')->with('message_fail','Telah terjadi kesalahan, Isi dengan benar');
        }
    }

}
