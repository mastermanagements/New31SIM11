<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_jenis_kompetensi as h_jk;

class JenisKompetensi extends Controller
{
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
        $data =[
            'hjk'=> h_jk::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.penilaian_karyawan.PA.jenisKompetensi.page_default', $data);
    }

    public function store(Request $req){

        $this->validate($req, [
           'nm_kompetensi'=> 'required'
        ]);

        $model= new h_jk();
        $model->nm_kompetensi = $req->nm_kompetensi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if ($model->save()){
            return redirect('jenis-kompetensi')->with('message_success','Anda telah menambahkan jenis kompetensi baru');
        }else{
            return redirect('jenis-kompetensi')->with('message_fail','Maaf, data kompetensi gagal ditambahkan');
        }
    }

    public function edit($id){
        if (empty($model = h_jk::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        return response()->json($model);
    }

    public function update(Request $req){

        $this->validate($req, [
            'nm_kompetensi'=> 'required',
            'id'=> 'required',
        ]);

        $model=  h_jk::find($req->id);
        $model->nm_kompetensi = $req->nm_kompetensi;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if ($model->save()){
            return redirect('jenis-kompetensi')->with('message_success','Anda telah mengubah jenis kompetensi baru');
        }else{
            return redirect('jenis-kompetensi')->with('message_fail','Maaf, data kompetensi gagal diubah');
        }
    }

    public function delete(Request $req,$id){

        $model=  h_jk::find($req->id);
        if ($model->delete()){
            return redirect('jenis-kompetensi')->with('message_success','Anda telah menghapus jenis kompetensi baru');
        }else{
            return redirect('jenis-kompetensi')->with('message_fail','Maaf, data kompetensi gagal dihapus');
        }
    }
}
