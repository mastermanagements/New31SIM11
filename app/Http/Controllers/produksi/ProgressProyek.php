<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Produksi\Proyek as proyek;
use App\Model\Produksi\ProgressProyek as progress_proyek;
use Session;

class ProgressProyek extends Controller
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
        $data=[
            'proyek'=>proyek::where('id_perusahaan', $this->id_perusahaan)->paginate(15),
        ];
        return view('user.produksi.section.progressProyek.page_default', $data);
    }

    public function listOfProgress(Request $req, $id)
    {
        $data=[
            'id_jadwal_proyek'=> $id,
            'data_progress' => progress_proyek::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->get()
        ];
        return view('user.produksi.section.progressProyek.crud.page_create', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'tgl_dikerjakan'=> 'required',
            'masalah' => 'required',
            'solusi' => 'required',
            'rincian_pekerjaan' => 'required',
            'id_jadwal_proyek' => 'required',
        ]);

        $tgl_dikerjakan = date('Y-m-d', strtotime($req->tgl_dikerjakan));
        $masalah = $req->masalah;
        $solusi = $req->solusi;
        $rincian_pekerjaan = $req->rincian_pekerjaan;
        $id_jadwal_proyek = $req->id_jadwal_proyek;

        $model = new progress_proyek;
        $model->id_jadwal_proyek = $id_jadwal_proyek;
        $model->tgl_dikerjakan =$tgl_dikerjakan;
        $model->masalah= $masalah;
        $model->solusi= $solusi;
        $model->rincian_pekerjaan= $rincian_pekerjaan;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('Daftar-progress/'.$id_jadwal_proyek)->with('message_success', 'Anda telah menambahkan progress proyek anda');
        }else{
            return redirect('Daftar-progress/'.$id_jadwal_proyek)->with('message_fail', 'Maaf, telah terjadi kesalahan');
        }
    }

    public function edit($id)
    {

        if(empty($model = progress_proyek::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()) ){
            return abort(404);
        }

        return response()->json($model);
    }

    public function update(Request $req){
        $this->validate($req,[
            'tgl_dikerjakan_ubah'=> 'required',
            'masalah_ubah' => 'required',
            'solusi_ubah' => 'required',
            'rincian_pekerjaan_ubah' => 'required',
            'id_jadwal_proyek' => 'required',
            'id_progress_proyek' => 'required',
        ]);

        $tgl_dikerjakan = date('Y-m-d', strtotime($req->tgl_dikerjakan_ubah));
        $masalah = $req->masalah_ubah;
        $solusi = $req->solusi_ubah;
        $rincian_pekerjaan = $req->rincian_pekerjaan_ubah;
        $id_jadwal_proyek = $req->id_jadwal_proyek;

        $model = progress_proyek::find($req->id_progress_proyek);
        $model->id_jadwal_proyek = $id_jadwal_proyek;
        $model->tgl_dikerjakan =$tgl_dikerjakan;
        $model->masalah= $masalah;
        $model->solusi= $solusi;
        $model->rincian_pekerjaan= $rincian_pekerjaan;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save()){
            return redirect('Daftar-progress/'.$id_jadwal_proyek)->with('message_success', 'Anda telah mengubah progress proyek anda');
        }else{
            return redirect('Daftar-progress/'.$id_jadwal_proyek)->with('message_fail', 'Maaf, telah terjadi kesalahan');
        }
    }

    public function destroy(Request $req,$id){
        if(empty($model = progress_proyek::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()) ){
            return abort(404);
        }
        if($model->delete()){
            $data=[
              'message'=>'Data Progress Berhasil dihapus',
              'status'=>'true'
            ];
            return response()->json($data);
        }else{
            $data=[
                'message'=>'Data Progress gagal dihapus',
                'status'=>'false'
            ];
            return response()->json($data);
        }

    }
}
