<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\Sop as sops;

class Sop extends Controller
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

    public function index()
    {
        $data = [
            'sop' => sops::where('id_perusahaan', $this->id_perusahaan)->paginate(15)
        ];
        return view('user.hrd.section.sop.page_default', $data);
    }

    public function create()
    {
        return view('user.hrd.section.sop.page_create');
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'nm_sop'=>'required',
            'isi_sop'=> 'required'
        ]);

        $model = new sops();
        $model-> nm_sop= $req->nm_sop;
        $model-> isi_sop = $req->isi_sop;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save())
        {
            return redirect('SOP')->with('message_success','Standar Operasional Prosedur Berhasil Disimpan');
        }
        else {
            return redirect('SOP')->with('message_fail','Standar Operasional Prosedur Tidak Dapat Disimpan');
        }
    }

    public function edit($id)
    {
        if(empty($model=sops::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
            'sop' => $model
        ];
        return view('user.hrd.section.sop.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'nm_sop'=>'required',
            'isi_sop'=> 'required'
        ]);

        $model = sops::find($id);
        $model-> nm_sop= $req->nm_sop;
        $model-> isi_sop = $req->isi_sop;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save())
        {
            return redirect('SOP')->with('message_success','Standar Operasional Prosedur Berhasil Diubah');
        }
        else {
            return redirect('SOP')->with('message_fail','Standar Operasional Prosedur Tidak Dapat Diubah');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = sops::find($id);
        if($model->delete())
        {
            return redirect('SOP')->with('message_success','Standar Operasional Prosedur Berhasil Dihapus');
        }
        else {
            return redirect('SOP')->with('message_fail','Standar Operasional Prosedur Tidak Dapat Dihapus');
        }
    }
}
