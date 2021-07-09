<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Superadmin_ukm\H_karyawan as karyawans;
use App\Model\Hrd\H_tenaga_kerja as tenaga_kerja;


class TenagaKerja extends Controller
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

    public function index(){
        $data =[
            'data_karyawan' => karyawans::where('id_perusahaan', $this->id_perusahaan)->paginate(20),
        ];
        return view('user.hrd.section.tenaga_ahli.page_default', $data);
    }

    public function show(Request $req){
        $nm_ky = $req->nm_ky;
        $data =[
            'data_karyawan' => karyawans::where('nama_ky', 'LIKE',"%{$nm_ky}%")->where('id_perusahaan', $this->id_perusahaan)->paginate(20),
        ];
        return view('user.hrd.section.tenaga_ahli.page_default', $data);
    }

    public function daftarSertifikasi($id)
    {
        if(empty($model = karyawans::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $model_sertifikasi = tenaga_kerja::all()->where('id_ky', $model->id);

        $data = [
            'data_profil_karyawan'=> $model,
            'sertifikasi'=>$model_sertifikasi
        ];
        return view('user.hrd.section.tenaga_ahli.crud.page_detail', $data);
    }

    public function create($id_user){
        $data = [
            'id_ky'=> $id_user
        ];
        return view('user.hrd.section.tenaga_ahli.crud.page_create', $data);
    }

    public function store(Request $req){

        $this->validate($req,[
          "id_ky" => "required",
          "lembaga_sertifikasi" => "required",
          "no_sertifikat" => "required",
          "klasifikasi" => "required",
          "no_registrasi" => "required",
          "ditetapkan" => "required",
          "tgl_penetapan" => "required",
          "masa_berlaku" => "required",
          "asosiasi" => "required",
          "no_anggota" => "required",
          "posisi_proyek" => "required"
        ]);

        $id_ky = $req->id_ky;
        $lembaga_sertifikasi= $req->lembaga_sertifikasi;
        $no_sertifikat= $req->no_sertifikat;
        $klasifikasi= $req->klasifikasi;
        $no_registrasi= $req->no_registrasi;
        $ditetapkan= $req->ditetapkan;
        $masa_berlaku= $req->masa_berlaku;
        $tgl_penetapan= $req->tgl_penetapan;
        $asosiasi= $req->asosiasi;
        $no_anggota= $req->no_anggota;
        $posisi_proyek= $req->posisi_proyek;

        $model =new tenaga_kerja([
            'id_ky'=>$id_ky,
            'lembaga_sertifikasi'=>$lembaga_sertifikasi,
            'no_sertifikat'=>$no_sertifikat,
            'klasifikasi'=>$klasifikasi,
            'no_registrasi'=>$no_registrasi,
            'ditetapkan'=>$ditetapkan,
            'tgl_penetapan'=>date('Y-m-d', strtotime($tgl_penetapan)),
            'masa_berlaku'=>$masa_berlaku,
            'asosiosi'=>$asosiasi,
            'no_anggota'=>$no_anggota,
            'posisi_proyek'=>$posisi_proyek,
            'id_perusahaan'=> $this->id_perusahaan,
            'id_karyawan'=> $this->id_karyawan]);

        if($model->save()){
            return redirect('daftar-sertifikasi/'.$model->id_ky)->with('message_success', 'Sertifikasi baru telah ditanyakan');
        }else{
            return redirect('daftar-sertifikasi/'.$model->id_ky)->with('message_fail', 'Maaf,Sertifikai gagal dimasukan');
        }
    }

    public function edit($id){
        if(empty($model = tenaga_kerja::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data = [
            'sertifikasi'=> $model
        ];
        return view('user.hrd.section.tenaga_ahli.crud.page_edit', $data);
    }

    public function update(Request $req, $id){

        $this->validate($req,[
            "id_ky" => "required",
            "lembaga_sertifikasi" => "required",
            "no_sertifikat" => "required",
            "klasifikasi" => "required",
            "no_registrasi" => "required",
            "ditetapkan" => "required",
            "tgl_penetapan" => "required",
            "masa_berlaku" => "required",
            "asosiasi" => "required",
            "no_anggota" => "required",
            "posisi_proyek" => "required"
        ]);

        $id_ky = $req->id_ky;
        $lembaga_sertifikasi= $req->lembaga_sertifikasi;
        $no_sertifikat= $req->no_sertifikat;
        $klasifikasi= $req->klasifikasi;
        $no_registrasi= $req->no_registrasi;
        $ditetapkan= $req->ditetapkan;
        $masa_berlaku= $req->masa_berlaku;
        $tgl_penetapan= $req->tgl_penetapan;
        $asosiasi= $req->asosiasi;
        $no_anggota= $req->no_anggota;
        $posisi_proyek= $req->posisi_proyek;

        $model =tenaga_kerja::find($id);
        $model->id_ky = $id_ky;
        $model->lembaga_sertifikasi=$lembaga_sertifikasi;
        $model->no_sertifikat=$no_sertifikat;
        $model->klasifikasi=$klasifikasi;
        $model->no_registrasi=$no_registrasi;
        $model->ditetapkan=$ditetapkan;
        $model->tgl_penetapan=date('Y-m-d', strtotime($tgl_penetapan));
        $model->masa_berlaku=$masa_berlaku;
        $model->asosiosi=$asosiasi;
        $model->no_anggota=$no_anggota;
        $model->posisi_proyek=$posisi_proyek;
        $model->id_perusahaan= $this->id_perusahaan;
        $model->id_karyawan= $this->id_karyawan;

        if($model->save())
        {
            return redirect('daftar-sertifikasi/'.$model->id_ky)->with('message_success', 'Sertifikasi baru saja diubah');
        }else{
            return redirect('daftar-sertifikasi/'.$model->id_ky)->with('message_fail', 'Maaf,Sertifikai gagal diubah');
        }
    }

    public function delete(Request $req, $id)
    {
        $model =tenaga_kerja::find($id);
        if($model->save())
        {
            return redirect('daftar-sertifikasi/'.$model->id_ky)->with('message_success', 'Sertifikasi baru saja dihapus');
        }else{
            return redirect('daftar-sertifikasi/'.$model->id_ky)->with('message_fail', 'Maaf,Sertifikai gagal dihapus');
        }
    }

}
