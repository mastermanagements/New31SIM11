<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Karyawan\SJP as sjps;
use Session;

class SJP extends Controller
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
        return view('user.karyawan.section.SJP.page_default', $data_pass);
    }

    public function create()
    {
        return view('user.karyawan.section.SJP.page_create');
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'periode'=> 'required|numeric',
            'isi_sjpg'=> 'required'
        ]);

        $periode = $req->periode;
        $isi_sjpg = $req->isi_sjpg;

        $model = new sjps;
        $model->periode = $periode;
        $model->isi_sjpg = $isi_sjpg;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Strategi-Jangka-Panjang')->with('message_success', 'Ada telah menambahkan strategi baru');
        }else{
            return redirect('Strategi-Jangka-Panjang')->with('message_fail', 'Terjadi Kesalahan, Silahkan masukan ulang strategi anda');
        }
    }


    public function edit($id)
    {
        if(empty($data_sjp = sjps::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data_pass = [
          'data_strategi'=> $data_sjp
        ];
        return view('user.karyawan.section.SJP.page_edit', $data_pass);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'periode'=> 'required|numeric',
            'isi_sjpg'=> 'required'
        ]);

        $periode = $req->periode;
        $isi_sjpg = $req->isi_sjpg;

        $model = sjps::find($id);
        $model->periode = $periode;
        $model->isi_sjpg = $isi_sjpg;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Strategi-Jangka-Panjang')->with('message_success', 'Ada telah mengubah strategi anda');
        }else{
            return redirect('Strategi-Jangka-Panjang')->with('message_fail', 'Terjadi Kesalahan, Silahkan ubah ulang strategi anda');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = sjps::find($id);
        if($model->delete()){
            return redirect('Strategi-Jangka-Panjang')->with('message_success', 'Ada telah mengapus strategi anda');
        }else{
            return redirect('Strategi-Jangka-Panjang')->with('message_fail', 'Terjadi Kesalahan, Silahkan ubah ulang strategi anda');
        }
    }
}
