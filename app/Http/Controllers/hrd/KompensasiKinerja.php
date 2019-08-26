<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_kompensasi_kinerja as Hkk;
use function Sodium\add;

class KompensasiKinerja extends Controller
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

    public function index(){
        $data=[
            'data'=> Hkk::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.kompensasi_kinerja.page_default', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'nilai_total_kinerja'=> 'required',
            'kenaikan_gaji'=> 'required',
        ]);


        $model= new Hkk();
        $model->nilai_total_kinerja = $req->nilai_total_kinerja;
        $model->kenaikan_gaji = $req->kenaikan_gaji;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Kompensasi-Kinerja')->with('message_success','Anda telah menambah Kompensasi Kinerja Baru');
        }else{
            return redirect('Kompensasi-Kinerja')->with('message_fail','Maaf, Kompensasi kinerja gagal ditambahkan');
        }
    }

    public function edit($id){
        if(empty($model= Hkk::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'nilai_total_kinerja'=> 'required',
            'kenaikan_gaji'=> 'required',
            'id'=> 'required',
        ]);


        $model= Hkk::find($req->id);
        $model->nilai_total_kinerja = $req->nilai_total_kinerja;
        $model->kenaikan_gaji = $req->kenaikan_gaji;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Kompensasi-Kinerja')->with('message_success','Anda telah mengubah Kompensasi Kinerja ');
        }else{
            return redirect('Kompensasi-Kinerja')->with('message_fail','Maaf, Kompensasi kinerja gagal diubah');
        }
    }

    public function delete(Request $req, $id){
        $model= Hkk::find($req->id);
        if($model->delete()){
            return redirect('Kompensasi-Kinerja')->with('message_success','Anda telah menghapus Kompensasi Kinerja ');
        }else{
            return redirect('Kompensasi-Kinerja')->with('message_fail','Maaf, Kompensasi kinerja gagal dihapus');
        }
    }
}
