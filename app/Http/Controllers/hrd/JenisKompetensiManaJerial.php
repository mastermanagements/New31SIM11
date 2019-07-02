<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_jenis_kompetensi as hjk;
use App\Model\Hrd\H_kompetensi_manajerial as hik;

class JenisKompetensiManaJerial extends Controller
{
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

    public function index(){
        $data = [
            'jenis_kompetensi'=>hjk::all()->where('id_perusahaan', $this->id_perusahaan),
            'data'=> hik::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.jenisKManajerial.page_default', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'id_jenis_kompetisi' => 'required',
            'nm_kompetensi_m' => 'required',
        ]);

        $model = new hik();
        $model->id_jenis_kompetensi = $req->id_jenis_kompetisi;
        $model->nm_kompetensi_m = $req->nm_kompetensi_m;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('kompetensi-majerial')->with('message_success','Anda telah menambahkan Item Kompetensi Majerial');
        }else{
            return redirect('kompetensi-majerial')->with('message_fail','Maaf, Item Kompetensi Majerial gagal untuk disimpan');
        }
    }

    public function edit($id){
        if(empty($model = hik::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req)
    {
        $this->validate($req,[
            'id_jenis_kompetisi' => 'required',
            'nm_kompetensi_m' => 'required',
            'id'=>'required'
        ]);

        $model = hik::find($req->id);
        $model->id_jenis_kompetensi = $req->id_jenis_kompetisi;
        $model->nm_kompetensi_m = $req->nm_kompetensi_m;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('kompetensi-majerial')->with('message_success','Anda telah menambahkan Item Kompetensi Majerial');
        }else{
            return redirect('kompetensi-majerial')->with('message_fail','Maaf, Item Kompetensi Majerial gagal untuk mengubah');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = hik::find($id);
        if($model->delete()){
            return redirect('kompetensi-majerial')->with('message_success','Anda telah menghapus Item Kompetensi Majerial');
        }else{
            return redirect('kompetensi-majerial')->with('message_fail','Maaf, Item Kompetensi Majerial gagal untuk menghapus');
        }
    }
}
