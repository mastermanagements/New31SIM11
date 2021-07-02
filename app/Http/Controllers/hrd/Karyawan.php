<?php

namespace App\Http\Controllers\hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\H_karyawan as karyawans;
use App\Model\Superadmin_ukm\U_jabatan_p as jbtn;
use Session;

class Karyawan extends Controller
{
    //

    private $id_karyawan;
    private $id_perusahaan;
    private $status = ['0'=>'Masih Hidup','1'=>'Meninggal Dunia'];
    private $agama=['Kristen','Hindu','Budha','Islam'];
    private $jenis_kelamin=['1'=>'Pria','2'=>'Wanita'];
    private $gol_darah=['A','B','O','AB'];
    private $status_kerja=['0'=>'Aktif','1'=>'Tidak Aktif'];
    private $id_superadmin;
    private $id_superadmin_karyawan;

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
            $this->id_superadmin_karyawan = Session::get('id_superadmin_karyawan');
            return $next($req);
        });
    }


    public function index()
    {
        $data =[
            'data_karyawan' => karyawans::where('id_perusahaan', $this->id_perusahaan)->paginate(20),
            'status'=> $this->status,
            'jabatan'=>jbtn::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.hrd.section.karyawan.page_default', $data);
    }

    public function cari(Request $req)
    {
        $nama_karyawan = $req->nm_ky;
        $data =[
            'data_karyawan' => karyawans::where('id_perusahaan', $this->id_perusahaan)->where('nama_ky','LIKE',"%{$nama_karyawan}%")->paginate(20),
            'status'=> $this->status
        ];
        return view('user.hrd.section.karyawan.page_default', $data);
    }

    public function tambah_karyawan()
    {
        $data_pass = [
            'agama' => $this->agama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'gol_darah' => $this->gol_darah,
            'status_kerja'=> $this->status_kerja,
        ];
        return view('user.hrd.section.karyawan.page_create',$data_pass);
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'nik' => 'required',
            'nama_ky' => 'required',
            'password' => 'required',
            'no_ktp' => 'required|numeric',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'tgl_masuk' => 'required',
            'jenis_kel' => 'required',
            'agama' => 'required',
            'status_kerja' => 'required',
            'gol_darah' => 'required',
            'nm_bank'=> 'required',
            'no_rek'=> 'required',
            'file_ktp'=> 'required|image|mimes:jpg,jpeg,png,gif',
            'cu_vitae'=> 'required|image|mimes:jpg,jpeg,png,gif',
            'pas_foto'=> 'required|image|mimes:jpg,jpeg,png,gif',
       ]);

        $nik = $req->nik;
        $nama_ky =  $req->nama_ky;
        $password =  bcrypt($req->password);
        $no_ktp =  $req->no_ktp;
        $tmp_lahir =  $req->tmp_lahir;
        $tgl_lahir =  $req->tgl_lahir;
        $jenis_kel =  $req->jenis_kel;
        $agama =  $req->agama;
        $status_kerja =  $req->status_kerja;
        $gol_darah =  $req->gol_darah;
        $nm_bank =  $req->nm_bank;
        $no_rek =  $req->no_rek;
        $file_ktp =  $req->file_ktp;
        $cu_vitae =  $req->cu_vitae;
        $pas_foto =  $req->pas_foto;
        $pend_akhir =  $req->pend_akhir;
        $program_studi =  $req->program_studi;
        $tgl_masuk =  $req->tgl_masuk;
        $pt =  $req->pt;
        $id_usaha =  $this->id_perusahaan;
        $id_superadmin =  $this->id_superadmin;

        $name_file_ktp = time()."-ktp.".$file_ktp->getClientOriginalExtension();
        $name_file_cv= time()."-cv.".$cu_vitae->getClientOriginalExtension();
        $name_file_pfoto= time()."-Pfoto.".$pas_foto->getClientOriginalExtension();

        $model = new karyawans;
        $model->nik = $nik;
        $model->nama_ky = $nama_ky;
        $model->password = $password;
        $model->tmp_lahir = $tmp_lahir;
        $model->tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
        $model->jenis_kel = $jenis_kel;
        $model->agama = $agama;
        $model->status_kerja = $status_kerja;
        $model->no_ktp = $no_ktp;
        $model->file_ktp = $name_file_ktp;
        $model->pas_foto = $name_file_pfoto;
        $model->cu_vitae = $name_file_cv;
        $model->nm_bank = $nm_bank;
        $model->no_rek = $no_rek;
        $model->gol_darah = $gol_darah;
        $model->pend_akhir = $pend_akhir;
        $model->program_studi = $program_studi;
        $model->pt = $pt;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_user_ukm = $this->id_superadmin_karyawan;
        $model->tgl_masuk = date('Y-m-d', strtotime($tgl_masuk));

        if($model->save())
        {
            if ($file_ktp->move(public_path('fileKtp'), $name_file_ktp) && $cu_vitae->move(public_path('fileCv'), $name_file_cv) &&   $pas_foto->move(public_path('filePFoto'), $name_file_pfoto)) {
                return redirect('Karyawan')->with('message_success','Berhasil menambah data karyawan');
            }else{
                return redirect('Karyawan')->with('message_error','Gagal menyimpan data karyawann');
            }
            return redirect('Karyawan')->with('message_success','Berhasil mengubah Data Karyawan');
        }
    }

    public function edit_karyawan($id)
    {
        if(empty($model=karyawans::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data_pass = [
            'agama' => $this->agama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'gol_darah' => $this->gol_darah,
            'status_kerja'=> $this->status_kerja,
            'data_karyawan' => $model
        ];
        return view('user.hrd.section.karyawan.page_edit',$data_pass);
    }

    public function update(Request $req, $id)
    {
       $this->validate($req, [
            'nik' => 'required',
            'nama_ky' => 'required',
            'password' => 'required',
            'no_ktp' => 'required|numeric',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'tgl_masuk' => 'required',
            'jenis_kel' => 'required',
            'agama' => 'required',
            'status_kerja' => 'required',
            'gol_darah' => 'required',
            'nm_bank'=> 'required',
            'no_rek'=> 'required',
            'file_ktp'=> 'required|image|mimes:jpg,jpeg,png,gif',
            'cu_vitae'=> 'required|image|mimes:jpg,jpeg,png,gif',
            'pas_foto'=> 'required|image|mimes:jpg,jpeg,png,gif',
        ]);

        $nik = $req->nik;
        $nama_ky =  $req->nama_ky;
        $password =  bcrypt($req->password);
        $no_ktp =  $req->no_ktp;
        $tmp_lahir =  $req->tmp_lahir;
        $tgl_lahir =  $req->tgl_lahir;
        $jenis_kel =  $req->jenis_kel;
        $agama =  $req->agama;
        $status_kerja =  $req->status_kerja;
        $gol_darah =  $req->gol_darah;
        $nm_bank =  $req->nm_bank;
        $no_rek =  $req->no_rek;
        $file_ktp =  $req->file_ktp;
        $cu_vitae =  $req->cu_vitae;
        $pas_foto =  $req->pas_foto;
        $pend_akhir =  $req->pend_akhir;
        $program_studi =  $req->program_studi;
        $tgl_masuk =  $req->tgl_masuk;
        $pt =  $req->pt;


        $name_file_ktp = time()."-ktp.".$file_ktp->getClientOriginalExtension();
        $name_file_cv= time()."-cv.".$cu_vitae->getClientOriginalExtension();
        $name_file_pfoto= time()."-Pfoto.".$pas_foto->getClientOriginalExtension();

        $model = karyawans::find($id);

        if(!empty($model->file_ktp))
        {
            $file_path =public_path('fileKtp').'/' . $model->file_ktp;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if(!empty($model->cu_vitae))
        {
            $file_path =public_path('fileCv').'/' . $model->cu_vitae;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if(!empty($model->pas_foto))
        {
            $file_path =public_path('filePFoto').'/' . $model->pas_foto;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }


        $model->nik = $nik;
        $model->nama_ky = $nama_ky;
        $model->password = $password;
        $model->tmp_lahir = $tmp_lahir;
        $model->tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
        $model->jenis_kel = $jenis_kel;
        $model->agama = $agama;
        $model->status_kerja = $status_kerja;
        $model->no_ktp = $no_ktp;
        $model->file_ktp = $name_file_ktp;
        $model->pas_foto = $name_file_pfoto;
        $model->cu_vitae = $name_file_cv;
        $model->nm_bank = $nm_bank;
        $model->no_rek = $no_rek;
        $model->gol_darah = $gol_darah;
        $model->pend_akhir = $pend_akhir;
        $model->program_studi = $program_studi;
        $model->pt = $pt;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_user_ukm = $this->id_superadmin_karyawan;
        $model->tgl_masuk = date('Y-m-d', strtotime($tgl_masuk));

        if($model->save())
        {
            if ($file_ktp->move(public_path('fileKtp'), $name_file_ktp) && $cu_vitae->move(public_path('fileCv'), $name_file_cv) &&   $pas_foto->move(public_path('filePFoto'), $name_file_pfoto)) {
                return redirect('Karyawan')->with('message_success','Berhasil mengubah data karyawan');
            }else{
                return redirect('Karyawan')->with('message_error','Gagal mengubah data karyawann');
            }
            return redirect('Karyawan')->with('message_success','Berhasil mengubah Data Karyawan');
        }
    }

    public function delete($id)
    {
        if(empty($model = karyawans::where('id',$id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        if(!empty($model->file_ktp))
        {
            $file_path =public_path('fileKtp').'/' . $model->file_ktp;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if(!empty($model->cu_vitae))
        {
            $file_path =public_path('fileCv').'/' . $model->cu_vitae;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if(!empty($model->pas_foto))
        {
            $file_path =public_path('filePFoto').'/' . $model->pas_foto;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }


        if($model->delete())
        {
               return redirect('Karyawan')->with('message_success','Berhasil menghapus data karyawan');
        }else{
            return redirect('Karyawan')->with('message_fail','Gagal menghapus Data Karyawan');
        }
    }
}
