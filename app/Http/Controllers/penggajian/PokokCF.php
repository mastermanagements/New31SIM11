<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\PokokCF as pcf;
class PokokCF extends Controller
{
    //

    private $id_karyawan;
    private $id_perusahaan;

    public function __construct()
    {
        $this->middleware(function($req, $next)
        {
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
        $data=[
          'data'=> pcf::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.ContentCF.pokokCF.page_default', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'nm_pokok_ccf'=> 'required'
        ]);

        $model= new pcf();
        $model->nm_pokok_ccf = $req->nm_pokok_ccf;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Pokok-cf')->with('message_success','Anda telah menambahkan pokok CF baru');
        }else{
            return redirect('Pokok-cf')->with('message_fail','Maaf, Pokok CF tidak tersimpan');
        }

    }

    public function edit($id)
    {
        if(empty($model = pcf::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        return response()->json($model);
    }

    public function update(Request $req)
    {
        $this->validate($req,[
            'nm_pokok_ccf'=> 'required',
            'id'=>'required'
        ]);

        $model= pcf::find($req->id);
        $model->nm_pokok_ccf = $req->nm_pokok_ccf;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Pokok-cf')->with('message_success','Anda telah mengubah pokok CF baru');
        }else{
            return redirect('Pokok-cf')->with('message_fail','Maaf, Pokok CF tidak terubah');
        }
    }

    public function delete(Request $req, $id)
    {
        $model= pcf::find($id);
        if($model->delete()){
            return redirect('Pokok-cf')->with('message_success','Anda telah menghapus pokok CF baru');
        }else{
            return redirect('Pokok-cf')->with('message_fail','Maaf, Pokok CF tidak terhapus');
        }
    }

}
