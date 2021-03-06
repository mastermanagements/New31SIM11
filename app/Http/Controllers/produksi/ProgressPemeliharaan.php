<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Produksi\Pemeliharaan as pemeliharaans;
use App\Model\Produksi\ProgressPemeliharaan as progress_pemeliharaan;

class ProgressPemeliharaan extends Controller
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
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

   /*  public function index()
    {
        $data = [
            'data_pemeliaraan'=> pemeliharaans::where('id_perusahaan', $this->id_perusahaan)->orderBy('created_at','desc')->paginate(15)
        ];
        return view('user.produksi.section.progrespPemeliharaan.page_default', $data);
    } */

    public function daftar_progress_pemeliharaan($id)
    {
        $data=[
            'data_progress'=> progress_pemeliharaan::where('id_pemeliharaan', $id)->orderBy('created_at','desc')->paginate(30),
            'id_pemeliharaan'=> $id
        ];
        return view('user.produksi.section.progrespPemeliharaan.crud.page_create', $data);
    }


    public function store(Request $req){
        $this->validate($req,[
           'tgl_dikerjakan' => 'required',
           'masalah' => 'required',
           'solusi' => 'required',
           'rincian_pekerjaan' => 'required',
           'id_pemeliharaan' => 'required',
        ]);

        $tgl_dikerjakan =date('Y-m-d', strtotime($req->tgl_dikerjakan));
        $masalah = $req->masalah;
        $solusi = $req->solusi;
        $rincian_pekerjaan= $req->rincian_pekerjaan;
        $id_pemeliharaan= $req->id_pemeliharaan;
        $ket= $req->ket;

        $model = new progress_pemeliharaan;
        $model->tgl_dikerjakan = $tgl_dikerjakan;
        $model->id_pemeliharaan = $id_pemeliharaan;
        $model->masalah = $masalah;
        $model->solusi = $solusi;
        $model->rincian_pekerjaan = $rincian_pekerjaan;
        $model->ket =$ket;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('lihat-progress/'.$model->id_pemeliharaan)->with('message_success','Anda telah memasukan progres pemeliharaan baru');
        }else{
            return redirect('lihat-progress/'.$model->id_pemeliharaan)->with('message_fail','Maaf, telah terjadi kesalahan');
        }
    }

    public function edit($id)
    {
        if(empty($model=progress_pemeliharaan::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        return response()->json($model);
    }

    public function update(Request $req)
    {
        $this->validate($req,[
            'tgl_dikerjakan_ubah' => 'required',
            'masalah_ubah' => 'required',
            'solusi_ubah' => 'required',
            'rincian_pekerjaan_ubah' => 'required',
            'id_pemeliharan' => 'required',
            'id_progress_pemeliharaan' => 'required',
        ]);

        $tgl_dikerjakan =date('Y-m-d', strtotime($req->tgl_dikerjakan_ubah));
        $masalah = $req->masalah_ubah;
        $solusi = $req->solusi_ubah;
        $rincian_pekerjaan= $req->rincian_pekerjaan_ubah;
        $id_pemeliharaan= $req->id_pemeliharan;
        $ket= $req->ket_ubah;
        $id_progress_pemeliharaan= $req->id_progress_pemeliharaan;

        $model = progress_pemeliharaan::find($id_progress_pemeliharaan);
        $model->tgl_dikerjakan = $tgl_dikerjakan;
        $model->id_pemeliharaan = $id_pemeliharaan;
        $model->masalah = $masalah;
        $model->solusi = $solusi;
        $model->rincian_pekerjaan = $rincian_pekerjaan;
        $model->ket =$ket;
        $model->id_perusahaan =$this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            return redirect('lihat-progress/'.$model->id_pemeliharaan)->with('message_success','Anda telah mengubah progres pemeliharaan ');
        }else{
            return redirect('lihat-progress/'.$model->id_pemeliharaan)->with('message_fail','Maaf, telah terjadi kesalahan');
        }
    }

    public function delete(Request $req, $id)
    {
        if(empty($model = progress_pemeliharaan::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }
        if($model->delete()){
            return redirect('lihat-progress/'.$model->id_pemeliharaan)->with('message_success','Anda telah menghapus progres pemeliharaan ');
        }else{
            return redirect('lihat-progress/'.$model->id_pemeliharaan)->with('message_fail','Maaf, telah terjadi kesalahan');
        }
    }
}
