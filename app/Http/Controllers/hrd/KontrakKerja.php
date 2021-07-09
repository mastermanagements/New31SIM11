<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as karyawan;
use App\Model\Hrd\H_jenis_kontrak as jenis_kontrak;
use App\Model\Hrd\KontrakKerja as kontrak_kerja;

class KontrakKerja extends Controller
{
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

    public function index(){
        Session::put('menu_tes','kontrak_kerja');
        $data = [
            'kontrak_kerja'=> kontrak_kerja::where('id_perusahaan', $this->id_perusahaan)->paginate(30),
            'karyawan'=> karyawan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.kontrak_kerja.page_default', $data);
    }

    public function cari(Request $req){
        Session::put('menu_tes','kontrak_kerja');
        $idKy = $req->id_ky;
        $data = [
            'kontrak_kerja'=> kontrak_kerja::where('id_ky', $idKy)->where('id_perusahaan', $this->id_perusahaan)->paginate(30),
            'karyawan'=> karyawan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.kontrak_kerja.page_default', $data);
    }

    public function create()
    {
        $data = [
            'karyawan' => karyawan::all()->where('id_perusahaan', $this->id_perusahaan),
            'jenis_kontrak'=> jenis_kontrak::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.kontrak_kerja.page_create', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'no_kontrak' => 'required',
            'id_ky' => 'required',
            'id_jenis_kontrak' => 'required',
            'tgl_masuk' => 'required',
            'tgl_selesai'=> 'required',
            'ket'=> 'required'
        ]);

        $no_kontrak= $req->no_kontrak;
        $id_ky= $req->id_ky;
        $id_jenis_kontrak= $req->id_jenis_kontrak;
        $tgl_masuk= date('Y-m-d', strtotime($req->tgl_masuk));
        $tgl_selesai= date('Y-m-d', strtotime($req->tgl_selesai));
        $ket= $req->ket;

        $model =new kontrak_kerja();
        $model->id_ky = $id_ky;
        $model->id_jenis_kontrak = $id_jenis_kontrak;
        $model->no_kontrak = $no_kontrak;
        $model->tgl_mulai = $tgl_masuk;
        $model->tgl_selesai = $tgl_selesai;
        $model->ket = $ket;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Kontrak-Kerja')->with('message_success','anda telah menambahkan kontrak kerja baru');
        }else{
            return redirect('Kontrak-Kerja')->with('message_fail','Maaf, telah terjadi kesalahan silahkan coba lagi');
        }
    }

    public function edit($id){
        if(empty($model = kontrak_kerja::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            'karyawan' => karyawan::all()->where('id_perusahaan', $this->id_perusahaan),
            'jenis_kontrak'=> jenis_kontrak::all()->where('id_perusahaan', $this->id_perusahaan),
            'data'=> $model
        ];
        return view('user.hrd.section.kontrak_kerja.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'no_kontrak' => 'required',
            'id_ky' => 'required',
            'id_jenis_kontrak' => 'required',
            'tgl_masuk' => 'required',
            'tgl_selesai'=> 'required',
            'ket'=> 'required'
        ]);

        $no_kontrak= $req->no_kontrak;
        $id_ky= $req->id_ky;
        $id_jenis_kontrak= $req->id_jenis_kontrak;
        $tgl_masuk= date('Y-m-d', strtotime($req->tgl_masuk));
        $tgl_selesai= date('Y-m-d', strtotime($req->tgl_selesai));
        $ket= $req->ket;

        $model =kontrak_kerja::find($id);
        $model->id_ky = $id_ky;
        $model->id_jenis_kontrak = $id_jenis_kontrak;
        $model->no_kontrak = $no_kontrak;
        $model->tgl_mulai = $tgl_masuk;
        $model->tgl_selesai = $tgl_selesai;
        $model->ket = $ket;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save()){
            return redirect('Kontrak-Kerja')->with('message_success','anda telah mengubah kontrak kerja No. '. $model->no_kontrak);
        }else{
            return redirect('Kontrak-Kerja')->with('message_fail','Maaf, telah terjadi kesalahan silahkan coba lagi');
        }
    }


    public function delete(Request $req, $id)
    {
      if(empty($model =kontrak_kerja::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
          return abort(404);
      }
       if($model->delete()){
            return redirect('Kontrak-Kerja')->with('message_success','anda telah mengubah kontrak kerja No. '. $model->no_kontrak);
        }else{
            return redirect('Kontrak-Kerja')->with('message_fail','Maaf, telah terjadi kesalahan silahkan coba lagi');
        }
    }

    public function upload_file(Request $req)
    {

        $this->validate($req,[
           'idKontrak' =>'required',
            'file_kontrak'=> 'required|file|mimes:rar,zip',
        ]);

        if(empty($model = kontrak_kerja::where('id', $req->idKontrak)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }



        $fileKontrakKerja = $req->file_kontrak;

        $name_file_ktp = time()."-kontrakKerja-.".$fileKontrakKerja->getClientOriginalExtension();
        if(!empty($model->file_kontrak))
        {
            $file_path =public_path('fileKontrakKerja').'/' . $model->file_kontrak	;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        $model->file_kontrak = $name_file_ktp;
        if($model->save()){
            $fileKontrakKerja->move(public_path('fileKontrakKerja'), $name_file_ktp);
            return redirect('Kontrak-Kerja')->with('message_success','Anda telah meng-unggah file kontrak kerja baru');
        }else{
            return redirect('Kontrak-Kerja')->with('message_fail','Maaf, telah terjadi gangguan. silahkan unggah ulang file anda');
        }
    }

    public function upload_fileTTD(Request $req)
    {
        $this->validate($req,[
           'idKontrakTtd' =>'required',
            'file_kontrakTtd'=> 'required|file|mimes:rar,zip',
        ]);

        if(empty($model = kontrak_kerja::where('id', $req->idKontrakTtd)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }



        $fileKontrakKerja = $req->file_kontrakTtd;

        $name_file_ktp = time()."-kontrakKerja-.".$fileKontrakKerja->getClientOriginalExtension();
        if(!empty($model->scan_kontrak))
        {
            $file_path =public_path('fileScanKontrakkerja').'/' . $model->scan_kontrak	;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        $model->scan_kontrak = $name_file_ktp;
        if($model->save()){
            $fileKontrakKerja->move(public_path('fileScanKontrakkerja'), $name_file_ktp);
            return redirect('Kontrak-Kerja')->with('message_success','Anda telah meng-unggah file kontrak kerja baru');
        }else{
            return redirect('Kontrak-Kerja')->with('message_fail','Maaf, telah terjadi gangguan. silahkan unggah ulang file anda');
        }
    }
}
