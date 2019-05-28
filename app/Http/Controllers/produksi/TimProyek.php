<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Proyek as proyeks;
use App\Model\Administrasi\SPKKontrak as spk;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;
use App\Model\Produksi\TimProyek as Tim_proyek;
use Session;

class TimProyek extends Controller
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
        $data = [
            'proyeks'=> proyeks::where('id_perusahaan', $this->id_perusahaan)->paginate(),
            'karyawan'=> karyawan::all()->where('id_perusahaan', $this->id_perusahaan),
            'spk'=> spk::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.produksi.section.timproyek.page_default', $data);
    }

    public function cari(Request $request)
    {
        $spk = $request->id_spk;
        $data = [
            'proyeks'=> proyeks::where('id_perusahaan', $this->id_perusahaan)->where('id_spk', $spk)->paginate(),
            'spk'=> spk::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.produksi.section.timproyek.page_default', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
           'id_ky'=> 'required',
           'id_proyek'=> 'required',
           'jabatan_proyek'=> 'required',
        ]);

        $id_ky = $req->id_ky;
        $id_proyek = $req->id_proyek;
        $jabatan_proyek = $req->jabatan_proyek;

        $model = new Tim_proyek;
        $model->id_proyek = $id_proyek;
        $model->id_ky = $id_ky;
        $model->jabatan_proyek = $jabatan_proyek;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect()->back()->with('message_success', 'anda telah menambahkan anggota tim ');
        }else{
            return redirect()->with('message_fail', 'Telah terjadi kesalahan, silahkan coba lagi');
        }

    }

    public function destroy(Request $req,$id)
    {
        if(empty($model = Tim_proyek::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        if($model->delete())
        {
            return redirect()->back()->with('message_success', 'anda telah menghapus anggota tim ');
        }else{
            return redirect()->with('message_fail', 'Telah terjadi kesalahan, silahkan coba lagi');
        }

    }

}
