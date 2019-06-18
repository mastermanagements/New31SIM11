<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Hrd\H_rencana_pelatihan as RencaPel;

class RencanaPelatihan extends Controller
{
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
        $data = [
          'data_pelatihan'=> RencaPel::where('id_perusahaan', $this->id_perusahaan)->paginate(15)
        ];
        return view('user.hrd.section.rencana_pelatihan.page_default', $data);
    }

    public function create()
    {
        return view('user.hrd.section.rencana_pelatihan.page_create');
    }

    public function store(Request $req){

        $this->validate($req,[
           'thn_anggaran'=> 'required',
           'tema'=> 'required',
           'tgl_pelatihan'=> 'required',
           'biaya'=> 'required'
        ]);

        $model = new RencaPel();
        $model->thn_anggaran = $req->thn_anggaran;
        $model->tema = $req->tema;
        $model->tgl_pelatihan = date('Y-m-d', strtotime($req->tgl_pelatihan));
        $model->biaya = $req->biaya;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if ($model->save()){
            return redirect('Rencana-Pelatihan')->with('message_success', 'Data Pelatihan Telah tersimpan');
        }else{
            return redirect('Rencana-Pelatihan')->with('message_fail', 'Data Pelatihan gagal tersimpan');
        }
    }

    public function edit($id)
    {
        if (empty($model = RencaPel::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
          'data'=> $model
        ];

        return view('user.hrd.section.rencana_pelatihan.page_edit', $data);
    }

    public function update(Request $req, $id){

        $this->validate($req,[
            'thn_anggaran'=> 'required',
            'tema'=> 'required',
            'tgl_pelatihan'=> 'required',
            'biaya'=> 'required'
        ]);

        $model = RencaPel::find($id);
        $model->thn_anggaran = $req->thn_anggaran;
        $model->tema = $req->tema;
        $model->tgl_pelatihan = date('Y-m-d', strtotime($req->tgl_pelatihan));
        $model->biaya = $req->biaya;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if ($model->save()){
            return redirect('Rencana-Pelatihan')->with('message_success', 'Data Pelatihan Telah terubah');
        }else{
            return redirect('Rencana-Pelatihan')->with('message_fail', 'Data Pelatihan gagal terubah');
        }
    }

    public function delete(Request $req, $id){
        $model = RencaPel::find($id);
        if ($model->delete()){
            return redirect('Rencana-Pelatihan')->with('message_success', 'Data Pelatihan Telah terhapus');
        }else{
            return redirect('Rencana-Pelatihan')->with('message_fail', 'Data Pelatihan gagal terhapus');
        }
    }

    public function daftar_karyawan()
    {
        return "cooming soon";

    }

}
