<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_periode_kerja as periodeker;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;

class PeriodeKerja extends Controller
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
        $model = periodeker::all()->where('id_perusahaan', $this->id_perusahaan);
        $data = [
            'data_periode'=>$model
        ];
        return view('user.hrd.section.periode_kerja.page_default', $data);
    }

    public function create()
    {
        $data = [
          'data_karyawan' => karyawan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.periode_kerja.page_create', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
          "id_ky" => "required",
          "mulai_kerja" => "required",
          "selesai_kerja" => "required",
          "alasan_selesai" => "required",
        ]);

        $id_ky = $req->id_ky;
        $mulai_kerja = date('Y-m-d', strtotime($req->mulai_kerja));
        $selesai_kerja = date('Y-m-d', strtotime($req->selesai_kerja));
        $alasan_selesai = $req->alasan_selesai;

        $model = new periodeker();
        $model->id_ky = $id_ky;
        $model->mulai_kerja = $mulai_kerja;
        $model->selesai_kerja = $selesai_kerja;
        $model->alasan_selesai = $alasan_selesai;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save())
        {
            return redirect('Periode-Kerja')->with('message_success', 'Anda telah menambahkan periode kerja untuk '.$model->karyawan->nm_ky);
        }else{
            return redirect('Periode-Kerja')->with('message_fail', 'Maaf, Periode kerja gagal dimasukan');
        }
    }

    public function edit($id)
    {
        if(empty($model = periodeker::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            'data_karyawan' => karyawan::all()->where('id_perusahaan', $this->id_perusahaan),
            'periode_kerja' => $model
        ];
        return view('user.hrd.section.periode_kerja.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            "id_ky" => "required",
            "mulai_kerja" => "required",
            "selesai_kerja" => "required",
            "alasan_selesai" => "required",
        ]);

        $id_ky = $req->id_ky;
        $mulai_kerja = date('Y-m-d', strtotime($req->mulai_kerja));
        $selesai_kerja = date('Y-m-d', strtotime($req->selesai_kerja));
        $alasan_selesai = $req->alasan_selesai;

        $model = periodeker::find($id);
        $model->id_ky = $id_ky;
        $model->mulai_kerja = $mulai_kerja;
        $model->selesai_kerja = $selesai_kerja;
        $model->alasan_selesai = $alasan_selesai;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save())
        {
            return redirect('Periode-Kerja')->with('message_success', 'Anda telah mengubah periode kerja untuk '.$model->karyawan->nama_ky);
        }else{
            return redirect('Periode-Kerja')->with('message_fail', 'Maaf, Periode kerja gagal mengubah');
        }
    }



    public function delete(Request $req, $id)
    {
        $model = periodeker::find($id);
        if($model->delete())
        {
            return redirect('Periode-Kerja')->with('message_success', 'Anda telah menghapus periode kerja untuk '.$model->karyawan->nama_ky);
        }else{
            return redirect('Periode-Kerja')->with('message_fail', 'Maaf, Periode kerja gagal menghapus');
        }
    }


}
