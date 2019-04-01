<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Karyawan\ModelBisnis as MB;

class ModelBisnis extends Controller
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
        $data= [
            'model_bisnis'=> MB::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.karyawan.section.ModelBisnis.page_default', $data);
    }

    public function create()
    {
        return view('user.karyawan.section.ModelBisnis.page_create');
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'nm_mb' => 'required',
            'sasaran' => 'required'
        ]);

        $nm_mb = $req->nm_mb;
        $sasaran = $req->sasaran;

        $model= new MB;
        $model->nm_mb=$nm_mb;
        $model->sasaran=$sasaran;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save())
        {
            return redirect('Model-Bisnis')->with('message_success', 'Anda telah menambahkan model bisnis');
        }else{
            return redirect('Model-Bisnis')->with('message_fail', 'Terjadi kesalahan, silahkan menambahkan model bisnis anda ..!!');
        }

    }

    public function edit($id)
    {
        if(empty($dataMB = MB::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data=[
          'mb'=> $dataMB
        ];

        return view('user.karyawan.section.ModelBisnis.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'nm_mb' => 'required',
            'sasaran' => 'required'
        ]);
        $nm_mb = $req->nm_mb;
        $sasaran = $req->sasaran;

        if(empty($model= MB::where('id',  $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $model->nm_mb=$nm_mb;
        $model->sasaran=$sasaran;
        $model->id_perusahaan=$this->id_perusahaan;
        $model->id_karyawan=$this->id_karyawan;

        if($model->save())
        {
            return redirect('Model-Bisnis')->with('message_success', 'Anda telah mengubah model bisnis');
        }else{
            return redirect('Model-Bisnis')->with('message_fail', 'Terjadi kesalahan, silahkan mengubah model bisnis anda ..!!');
        }

    }

    public function delete(Request $req, $id)
    {
        if(empty($model= MB::where('id',  $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        if($model->delete())
        {
            return redirect('Model-Bisnis')->with('message_success', 'Anda telah menghapus model bisnis');
        }else{
            return redirect('Model-Bisnis')->with('message_fail', 'Terjadi kesalahan, silahkan menghapus model bisnis anda ..!!');
        }

    }
}
