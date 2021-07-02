<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_lamaran_pek as pelamar;
use App\Model\Hrd\H_item_keahlian as item_keahlian;
use App\Model\Hrd\H_tes_keahlian as keahlian;

class TesKeahlian extends Controller
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

    public function index($id)
    {
        if(empty($data_pelamar = pelamar::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data_pass = [
            'pelamar'=> $data_pelamar,
            'item_keahlian'=> item_keahlian::all()->where('id_perusahaan', $this->id_perusahaan),
            'penilaian'=> keahlian::all()->where('id_lamaran_p', $data_pelamar->id)
        ];

        return view('user.hrd.section.tes.keahlian.penilaian.page_default', $data_pass);
    }

    public function create($id){

        if(empty($data_pelamar = pelamar::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data_pass = [
            'pelamar'=> $data_pelamar,
            'item_keahlian'=> item_keahlian::all()->where('id_perusahaan', $this->id_perusahaan)
        ];

        return view('user.hrd.section.tes.keahlian.penilaian.page_create', $data_pass);
    }

    public function store(Request $req, $id){
        $this->validate($req,[
            'id_item_tes_keahlian'=>'required',
            'nilai_akhir' => 'required',
            'ket' => 'required'
        ]);

        $id_item_tes_keahlian = $req->id_item_tes_keahlian;
        $nilai_akhir = $req->nilai_akhir;
        $ket = $req->ket;

        $model = new keahlian();
        $model->id_lamaran_p = $id;
        $model->id_item_tes_keahlian = $id_item_tes_keahlian;
        $model->nilai_akhir = $nilai_akhir;
        $model->ket = $ket;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('mulai-tes-keahlian/'.$model->id_lamaran_p)->with('message_success', 'Anda telah menambahkan penilaian kealian baru');
        }else{
            return redirect('mulai-tes-keahlian/'.$model->id_lamaran_p)->with('message_fail', 'Maaf, telah terjadi kesalahan');
        }

    }

    public function edit($id){

        if(empty($penilaian = keahlian::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data_pass = [
            'pelamar'=> $penilaian,
            'item_keahlian'=> item_keahlian::all()->where('id_perusahaan', $this->id_perusahaan)
        ];

        return view('user.hrd.section.tes.keahlian.penilaian.page_edit', $data_pass);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'id_item_tes_keahlian'=>'required',
            'nilai_akhir' => 'required',
            'ket' => 'required'
        ]);

        $id_item_tes_keahlian = $req->id_item_tes_keahlian;
        $nilai_akhir = $req->nilai_akhir;
        $ket = $req->ket;

        $model = keahlian::find($id);
        $model->id_item_tes_keahlian = $id_item_tes_keahlian;
        $model->nilai_akhir = $nilai_akhir;
        $model->ket = $ket;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('mulai-tes-keahlian/'.$model->id_lamaran_p)->with('message_success', 'Anda telah mengubah penilaian kealian baru');
        }else{
            return redirect('mulai-tes-keahlian/'.$model->id_lamaran_p)->with('message_fail', 'Maaf, telah terjadi kesalahan');
        }

    }

    public function delete(Request $req, $id){
        $model = keahlian::find($id);
        if($model->delete()){
            return redirect('mulai-tes-keahlian/'.$model->id_lamaran_p)->with('message_success', 'Anda telah menghapus penilaian kealian baru');
        }else{
            return redirect('mulai-tes-keahlian/'.$model->id_lamaran_p)->with('message_fail', 'Maaf, telah terjadi kesalahan');
        }
    }
}
