<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Penggajian\CompansableFators as cf;
use App\Model\Penggajian\G_sub_cf as scf;
use App\Model\Penggajian\G_content_cf as G_cf;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;
class ContentCF extends Controller
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

    public function index(){
        $data = [
            'jabatan'=> jabatan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.ContentCF.page_default', $data);
    }

    public function create($id)
    {
        if(empty($model = scf::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            'cf'=> $model
        ];
        return view('user.penggajian.section.ContentCF.crudCCF.page_default', $data);
    }

    public function store(Request $req){
       // dd($req->all());
        $this->validate($req,[
           'id_pokok_cf'=> 'required',
           'kolom_content'=> 'required',
           'content_cf'=> 'required',
           'bobot_content_cf'=> 'required',
           'bobot_content_cf'=> 'required',
        ]);

        $model = new G_cf();
        $model->id_pokok = $req->id_pokok_cf;
        $model->kolom_content = $req->kolom_content;
        $model->content_cf = $req->content_cf;
        $model->bobot_content_cf = implode(',', $req->bobot_content_cf);
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('content-cf/'.$req->id_sub_cf)->with('message_success', 'Anda telah menambahkan konten cf baru');
        }else{
            return redirect('content-cf/'.$req->id_sub_cf)->with('message_fail', 'Maaf, Kontent cf tidak dapat disimpan');
        }
    }
}
