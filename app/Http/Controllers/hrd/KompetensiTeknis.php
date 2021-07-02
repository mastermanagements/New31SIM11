<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hrd\H_jenis_kompetensi as hjk;
use App\Model\Superadmin_ukm\U_jabatan_p as hjky;
use App\Model\Hrd\H_kompetensi_teknis as hkt;
use Session;

class KompetensiTeknis extends Controller
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
        $data = [
            'jenis_kompetensi'=> hjk::all()->where('id_perusahaan', $this->id_perusahaan),
            'jabatan'=> hjky::all()->where('id_perusahaan', $this->id_perusahaan),
            'data'=> hkt::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.KompetensiTeknis.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
           'id_jenis_kompetisi' => 'required',
           'id_jabatan_p' => 'required',
           'nm_kompetensi_t' => 'required',
        ]);

        $model = new hkt();
        $model->id_jenis_kompetensi = $req->id_jenis_kompetisi;
        $model->id_jabatan = $req->id_jabatan_p;
        $model->nm_kompetensi_t = $req->nm_kompetensi_t;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('kompetensi-teknis')->with('message_success', 'Anda telah menambahkan Kompetensi teksi baru');
        }else{
            return redirect('kompetensi-teknis')->with('message_fail', 'Maaf, gagal menyimpan data kompetensi teksi');
        }
    }

    public function edit($id){
        if(empty($model = hkt::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){

        $this->validate($req,[
            'id_jenis_kompetisi' => 'required',
            'id_jabatan_p' => 'required',
            'nm_kompetensi_t' => 'required',
            'id' => 'required',
        ]);

        $model = hkt::find($req->id);
        $model->id_jenis_kompetensi = $req->id_jenis_kompetisi;
        $model->id_jabatan = $req->id_jabatan_p;
        $model->nm_kompetensi_t = $req->nm_kompetensi_t;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('kompetensi-teknis')->with('message_success', 'Anda telah mengubah Kompetensi teknis');
        }else{
            return redirect('kompetensi-teknis')->with('message_fail', 'Maaf, gagal menyimpan data kompetensi teknis');
        }
    }


    public function delete(Request $req, $id){
        $model = hkt::find($id);
        if($model->delete()){
            return redirect('kompetensi-teknis')->with('message_success', 'Anda telah menghapus Kompetensi teknis');
        }else{
            return redirect('kompetensi-teknis')->with('message_fail', 'Maaf, gagal menghapus data kompetensi teknis');
        }
    }
}
