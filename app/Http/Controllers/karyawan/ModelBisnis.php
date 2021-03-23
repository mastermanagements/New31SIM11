<?php

namespace App\Http\Controllers\karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Karyawan\ModelBisnis as MB;
use App\Model\Karyawan\JenisModelBisnis as JMB;
use App\Model\Karyawan\SubModelBisnis as SMB;

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
            'model_bisnis'=> MB::all()->where('id_perusahaan', $this->id_perusahaan),
            'jenis_mb'=>JMB::all()
        ];
        return view('user.karyawan.section.ModelBisnis.page_default', $data);
    }

    public function create()
    {
        $data= [
          'jenis_mb'=>JMB::all()
        ];
        return view('user.karyawan.section.ModelBisnis.page_create',$data);
    }

    public function getSubModelBisnis($id=1)
    {
        $model = SMB::all()->where('id_jenis_mb', $id);
        return $model;
    }

    public function ResponseSubModelBisnis($id_jenis_mb){
        return response()->json($this->getSubModelBisnis($id_jenis_mb));
    }

    public function store(Request $req)
    {
        $this->validate($req,[
          'id_jenis_mb' => 'required',
          'id_sub_mb' => 'required',
          'isi' => 'required'
        ]);

        $id_jenis_mb = $req->id_jenis_mb;
        $id_sub_mb = $req->id_sub_mb;
        $isi = $req->isi;

        $model= new MB;
        $model->id_jenis_mb = $id_jenis_mb;
        $model->id_sub_mb = $id_sub_mb;
        $model->isi = $isi;
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
          'mb'=> $dataMB,
          'jenis_mb'=>JMB::all(),
          'sub_mb'=>SMB::all()
        ];

        return view('user.karyawan.section.ModelBisnis.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'id_jenis_mb' => 'required',
            'id_sub_mb' => 'required',
            'isi' => 'required'
        ]);
        $id_jenis_mb = $req->id_jenis_mb;
        $id_sub_mb = $req->id_sub_mb;
        $isi = $req->isi;

        $model = MB::find($id);

        $model->id_jenis_mb=$id_jenis_mb;
        $model->id_sub_mb=$id_sub_mb;
        $model->isi = $isi;
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
