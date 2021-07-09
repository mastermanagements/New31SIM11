<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hrd\H_lamaran_pek as lamaran;
use App\Model\Hrd\H_loker as lokers;
use Session;

class LamaranPek extends Controller
{
    //
    private $id_karyawan;
    private $id_perusahaan;
    private $jenis_lamaran = [
        '0'=> 'Karyawan tetap',
        '1'=> 'Freelancer',
        '2'=> 'Karyawan Kontrak'
    ];
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
        $data=[
          'data_rekrutmen'=> lamaran::all()->where('id_perusahaan',$this->id_perusahaan)->sortByDesc('created_at'),
          'jenis_lamaran'=> $this->jenis_lamaran
        ];
        return view('user.hrd.section.lamaran_pek.page_default', $data);
    }

    public function create(){
        $data = [
            'loker'=> lokers::all()->where('id_perusahaan', $this->id_perusahaan),
            'jenis_lamaran'=> $this->jenis_lamaran
        ];
        return view('user.hrd.section.lamaran_pek.page_create',$data);
    }

    public function store(Request $req){
        $this->validate($req, [
            "nm_pel" => "required",
            "jenis_lamaran" => "required",
            "id_loker" => "required",
            "tgl_masuk" => "required",
            "posisi" => "required",
            "berkas_lamaran" =>'required|file|mimes:rar,zip'
        ]);

        $nm_pel = $req->nm_pel;
        $id_loker= $req->id_loker;
        $jenis_lamaran= $req->jenis_lamaran;
        $tgl_masuk= date('Y-m-d', strtotime($req->tgl_masuk));
        $berkas_lamaran = $req->berkas_lamaran;
        $posisi = $req->posisi;

        $name_file = uniqid().time().'.'.$berkas_lamaran->getClientOriginalExtension();
        $model = new lamaran;
        $model->id_loker= $id_loker;
        $model->nm_pel= $nm_pel;
        $model->posisi= $posisi;
        $model->jenis_lamaran= $jenis_lamaran;
        $model->tgl_masuk = $tgl_masuk;
        $model->berkas_lamaran = $name_file;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            $berkas_lamaran->move(public_path('fileCvLamaran'), $name_file);
            return redirect('Lamaran-Pekerjaan')->with('message_success','Anda telah menambah data lamaran');
        }else{
            return redirect('Lamaran-Pekerjaan')->with('message_fail','Gagal menyimpan data lamaran');
        }
    }

    public function edit($id){

        if(empty($model=lamaran::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data = [
            'jenis_lamaran'=> $this->jenis_lamaran,
            'loker'=> lokers::all()->where('id_perusahaan', $this->id_perusahaan),
            'data'=>$model
        ];
        return view('user.hrd.section.lamaran_pek.page_edit',$data);
    }

    public function update(Request $req, $id){

        $this->validate($req, [
            "nm_pel" => "required",
            "jenis_lamaran" => "required",
            "tgl_masuk" => "required",
            "id_loker" => "required",
            "posisi" => "required",
            "berkas_lamaran" =>'required|file|mimes:rar,zip'
        ]);

        $nm_pel = $req->nm_pel;
        $jenis_lamaran= $req->jenis_lamaran;
        $tgl_masuk= date('Y-m-d', strtotime($req->tgl_masuk));
        $berkas_lamaran = $req->berkas_lamaran;
        $posisi = $req->posisi;
        $id_loker= $req->id_loker;


        $model = lamaran::find($id);

        if(!empty($model->berkas_lamaran))
        {
            $file_path =public_path('fileCvLamaran').'/'.$model->berkas_lamaran;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        $name_file = uniqid().time().'.'.$berkas_lamaran->getClientOriginalExtension();
        $model->nm_pel= $nm_pel;
        $model->id_loker= $id_loker;
        $model->posisi= $posisi;
        $model->jenis_lamaran= $jenis_lamaran;
        $model->tgl_masuk = $tgl_masuk;
        $model->berkas_lamaran = $name_file;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save()){
            $berkas_lamaran->move(public_path('fileCvLamaran'), $name_file);
            return redirect('Lamaran-Pekerjaan')->with('message_success','Anda telah mengubah data lamaran');
        }else{
            return redirect('Lamaran-Pekerjaan')->with('message_fail','Gagal mengubah data lamaran');
        }
    }

    public function delete(Request $req, $id){
        if(empty($model = lamaran::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        if(!empty($model->berkas_lamaran)) {
            $file_path = public_path('fileCvLamaran') . '/' . $model->berkas_lamaran;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }
        if($model->delete()){
           return redirect('Lamaran-Pekerjaan')->with('message_success','Anda telah menghapus data lamaran');
        }else{
            return redirect('Lamaran-Pekerjaan')->with('message_fail','Gagal menghapus data lamaran');
        }
    }
}
