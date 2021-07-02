<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_jenis_kontrak as jenis_kontrak;

class JenisKontrakKerja extends Controller
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
        $data = [
            'jenis_kontrak'=>  jenis_kontrak::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        Session::put('menu_tes','jenis_kontrak');
        return view('user.hrd.section.kontrak_kerja.page_default', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'jenis_kontrak_kerja'=> 'required'
        ]);

        $jenis_kontrak_kerja =$req->jenis_kontrak_kerja;
        $model =new jenis_kontrak;
        $model->jenis_kontrak = $jenis_kontrak_kerja;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save()){
            return redirect('jenis-kontrak-kerja')->with('message_success', 'Jenis Kontrak telah ditambahkan');
        }else{
            return redirect('jenis-kontrak-kerja')->with('message_fail', 'Maaf, terlah terjadi kesalahan');
        }
    }

    public function edit($id)
    {
        if(empty($model = jenis_kontrak::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req)
    {
        $this->validate($req,[
            'jenis_kontrak_kerja_ubah'=> 'required',
            'id_jenis_kontrak_kerja' => 'required'
        ]);

        $jenis_kontrak_kerja =$req->jenis_kontrak_kerja_ubah;
        $model =jenis_kontrak::find($req->id_jenis_kontrak_kerja);
        $model->jenis_kontrak = $jenis_kontrak_kerja;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;
        if($model->save()){
            return redirect('jenis-kontrak-kerja')->with('message_success', 'Jenis Kontrak telah diubah');
        }else{
            return redirect('jenis-kontrak-kerja')->with('message_fail', 'Maaf, terlah terjadi kesalahan');
        }
    }

    public function delete(Request $req, $id)
    {
        if(empty($model=$model =jenis_kontrak::find($id))){
            return abort(404);
        }

        if($model->delete()){
            return redirect('jenis-kontrak-kerja')->with('message_success', 'Jenis Kontrak telah dihapus');
        }else{
            return redirect('jenis-kontrak-kerja')->with('message_fail', 'Maaf, terlah terjadi kesalahan');
        }
    }
}
