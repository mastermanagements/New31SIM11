<?php

namespace App\Http\Controllers\penggajian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;
use Session;
use App\Model\Penggajian\G_sub_cf as sb_cf;
class SubCF extends Controller
{
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
        $data =[
            'jabatan'=> jabatan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.penggajian.section.SubCompansableFactors.page_default', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'sub_faktor'=> 'required',
           'bobot_subcf'=> 'required',
           'definisi'=> 'required',
           'id_cf'=> 'required',
        ]);

        $model = new sb_cf();
        $model->id_cf = $req->id_cf;
        $model->sub_faktor = $req->sub_faktor;
        $model->definisi = $req->definisi;
        $model->bobot_subcf = $req->bobot_subcf;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Sub-Compansable-factors')->with('message_success','Anda telah menambhakan sub cf baru');
        }else{
            return redirect('Sub-Compansable-factors')->with('message_fail','Maaf, Sub cf tidak tersimpan');
        }
    }

    public function edit($id)
    {
        if(empty($model = sb_cf::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        return response()->json($model);
    }

    public function update(Request $req)
    {

        $this->validate($req,[
            'sub_faktor'=> 'required',
            'bobot_subcf'=> 'required',
            'definisi'=> 'required',
            'id_cf'=> 'required',
            'id'=> 'required',
        ]);

        $model = sb_cf::find($req->id);
        $model->id_cf = $req->id_cf;
        $model->sub_faktor = $req->sub_faktor;
        $model->definisi = $req->definisi;
        $model->bobot_subcf = $req->bobot_subcf;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Sub-Compansable-factors')->with('message_success','Anda telah mengubah sub cf baru');
        }else{
            return redirect('Sub-Compansable-factors')->with('message_fail','Maaf, menambah Sub cf tidak tersimpan');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = sb_cf::find($id);

        if($model->delete()){
            return redirect('Sub-Compansable-factors')->with('message_success','Anda telah menghapus sub cf baru');
        }else{
            return redirect('Sub-Compansable-factors')->with('message_fail','Maaf,  Sub cf tidak terhapus');
        }
    }
}
