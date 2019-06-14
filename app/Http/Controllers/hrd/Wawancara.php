<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_lamaran_pek as pelamar;
use App\Model\Hrd\H_item_wawancara as itemsWawacara;
use App\Model\Hrd\H_Wawancara as wancara;

class Wawancara extends Controller
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

    public function index($id_pelamar)
    {
        if(empty($model = pelamar::where('id', $id_pelamar)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data=[
          'pelamar' => $model,
          'penilaian'=> wancara::all()->where('id_lamaran_p', $model->id)->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.tes.wawancara.penilaian.page_default', $data);
    }

    public function create($id_pelamar){
        if(empty($model = pelamar::where('id', $id_pelamar)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            'itemWawancara'=> itemsWawacara::all()->where('id_perusahaan', $this->id_perusahaan),
            'pelamar'=> $model
        ];
        return view('user.hrd.section.tes.wawancara.penilaian.page_create', $data);
    }
    public function store(Request $req, $id)
    {
        $this->validate($req,[
            'id_item_wawancara'=> 'required',
            'nilai_akhir' => 'required',
        ]);

        $id_lamaran_p = $id;
        $tgl_wawancara = "2019-05-23";
        $id_item_wawancara = $req->id_item_wawancara;
        $nilai_akhir= $req->nilai_akhir;
        $ket= $req->ket;

        $model = new wancara();
        $model->id_lamaran_p = $id_lamaran_p;
        $model->tgl_wawancara = $tgl_wawancara;
        $model->id_item_wawancara = $id_item_wawancara;
        $model->nilai_akhir = $nilai_akhir;
        $model->ket = $ket;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('mulai-wawancara/'.$model->id_lamaran_p)->with('message_success','Anda telah memasukan penilaian anda');
        }else{
            return redirect('mulai-wawancara/'.$model->id_lamaran_p)->with('message_fail','Maaf, telah terjadi kesalahan silahkan coba lagi');
        }
    }

    public function edit($id){
        if(empty($model = wancara::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            'itemWawancara'=> itemsWawacara::all()->where('id_perusahaan', $this->id_perusahaan),
            'pelamar'=> $model
        ];
        return view('user.hrd.section.tes.wawancara.penilaian.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'id_item_wawancara'=> 'required',
            'nilai_akhir' => 'required',
        ]);

        $tgl_wawancara = "2019-05-23";
        $id_item_wawancara = $req->id_item_wawancara;
        $nilai_akhir= $req->nilai_akhir;
        $ket= $req->ket;

        $model = wancara::find($id);
        $model->tgl_wawancara = $tgl_wawancara;
        $model->id_item_wawancara = $id_item_wawancara;
        $model->nilai_akhir = $nilai_akhir;
        $model->ket = $ket;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('mulai-wawancara/'.$model->id_lamaran_p)->with('message_success','Anda telah mengubah penilaian anda');
        }else{
            return redirect('mulai-wawancara/'.$model->id_lamaran_p)->with('message_fail','Maaf, telah terjadi kesalahan silahkan coba lagi');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = wancara::find($id);
        if($model->delete()){
            return redirect('mulai-wawancara/'.$model->id_lamaran_p)->with('message_success','Anda telah menghapus penilaian anda');
        }else{
            return redirect('mulai-wawancara/'.$model->id_lamaran_p)->with('message_fail','Maaf, telah terjadi kesalahan silahkan coba lagi');
        }
    }
}
