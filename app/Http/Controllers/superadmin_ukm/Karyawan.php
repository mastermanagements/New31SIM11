<?php

namespace App\Http\Controllers\superadmin_ukm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Superadmin_ukm\H_karyawan as karyawans;
use App\Model\Superadmin_ukm\U_usaha as usaha;
use Session;
class Karyawan extends Controller
{
    //

    private $agama=['Kristen','Hindu','Budha','Islam'];
    private $jenis_kelamin=['1'=>'Pria','2'=>'Wanita'];
    private $gol_darah=['A','B','O','AB'];
    private $status_kerja=['0'=>'Aktif','1'=>'Tidak Aktif'];
    private $id_superadmin;


    public function __construct(){
        $this->middleware(function ($req, $next){
            if(empty(Session::get('id_superadmin_ukm')))
            {
                return redirect('login-page')->with('message_fail','Waktu masuk anda telah habis, Silahkan login Ulang..!');
            }
            $this->id_superadmin = Session::get('id_superadmin_ukm');
            Session::put('main_menu','pengaturan_awal-pengguna_karyawan');
            return $next($req);
        });
    }

    public function data_karyawan($id_usaha)
    {
        if(empty($data_usaha = usaha::where('id_user_ukm', $this->id_superadmin)->where('id', $id_usaha)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'content_menu'=>"karyawan",
            'data_karyawan'=> karyawans::all()->where('id_perusahaan', $id_usaha)->where('id_user_ukm', $this->id_superadmin),
            'id_usaha'=> $id_usaha
        ];

        return view('user.superadmin_ukm.master.section.karyawan_perusahaan.karyawan_view_page', $data_pass);
    }

    public function create($id_usaha)
    {
        if(empty($data_usaha = usaha::where('id_user_ukm', $this->id_superadmin)->where('id', $id_usaha)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'agama' => $this->agama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'gol_darah' => $this->gol_darah,
            'status_kerja'=> $this->status_kerja,
            'id_usaha' => $id_usaha
        ];
        return view('user.superadmin_ukm.master.section.karyawan_perusahaan.karyawan_create_page',$data_pass);
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
            'file_ktp'=> 'required|image|mimes:jpeg,jpg,png,gif',
            'cu_vitae'=> 'required|image|mimes:jpeg,jpg,png,gif',
            'pas_foto'=> 'required|image|mimes:jpeg,jpg,png,gif',
            'id_usaha'=> 'required|numeric'
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
        $id_usaha =  $req->id_usaha;
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
        $model->id_perusahaan = $id_usaha;
        $model->id_user_ukm = $id_superadmin;
        $model->tgl_masuk = date('Y-m-d', strtotime($tgl_masuk));

        if($model->save())
        {
            if ($file_ktp->move(public_path('fileKtp'), $name_file_ktp) && $cu_vitae->move(public_path('fileCv'), $name_file_cv) &&   $pas_foto->move(public_path('filePFoto'), $name_file_pfoto)) {
                return redirect('pengguna-karyawan')->with('message_success','Berhasil menambah data karyawan');
            }else{
                return redirect('daftarkan-karyawan/'. $id_usaha)->with('message_error','Gagal menyimpan data karyawann');
            }
            return redirect('pengguna-karyawan')->with('message_success','Berhasil mengubah Data Karyawan');
        }
    }

    public function edit($id_usaha, $id_karyawan)
    {
        if(empty($data_karyawan = karyawans::where('id', $id_karyawan)->where('id_user_ukm', $this->id_superadmin)->where('id_user_ukm', $this->id_superadmin)->where('id_perusahaan', $id_usaha)->first()))
        {
            return abort(404);
        }

        $data_pass = [
            'agama' => $this->agama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'gol_darah' => $this->gol_darah,
            'status_kerja'=> $this->status_kerja,
            'id_usaha' => $id_usaha,
            'data_karyawan' => $data_karyawan
        ];
        return view('user.superadmin_ukm.master.section.karyawan_perusahaan.karyawan_edit_page',$data_pass);
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
            'file_ktp'=> 'required|image|mimes:jpg,png,gif',
            'cu_vitae'=> 'required|image|mimes:jpg,png,gif',
            'pas_foto'=> 'required|image|mimes:jpg,png,gif',
            'id_usaha'=> 'required|numeric'
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
        $id_usaha =  $req->id_usaha;
        $id_superadmin =  $this->id_superadmin;

        $name_file_ktp = time()."-ktp.".$file_ktp->getClientOriginalExtension();
        $name_file_cv= time()."-cv.".$cu_vitae->getClientOriginalExtension();
        $name_file_pfoto= time()."-Pfoto.".$pas_foto->getClientOriginalExtension();

        $model = karyawans::findOrFail($id);

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
        $model->id_perusahaan = $id_usaha;
        $model->id_user_ukm = $id_superadmin;
        $model->tgl_masuk = date('Y-m-d', strtotime($tgl_masuk));


        if($model->save())
        {
            if ($file_ktp->move(public_path('fileKtp'), $name_file_ktp) && $cu_vitae->move(public_path('fileCv'), $name_file_cv) &&   $pas_foto->move(public_path('filePFoto'), $name_file_pfoto)) {
                return redirect('daftar-karyawan/'.$id_usaha)->with('message_success','Berhasil menambah data karyawan');
            }else{
                return redirect('daftarkan-karyawan/'.$id_usaha)->with('message_error','Gagal menyimpan data karyawann');
            }
            return redirect('daftar-karyawan/'.$id_usaha)->with('message_success','Berhasil mengubah Data Karyawan');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = karyawans::findOrFail($id);
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
            return redirect('daftar-karyawan/'.$model->id_perusahaan)->with('message_success','Berhasil mengubah Data Karyawan');
        }else{
            return redirect('pengguna-karyawan')->with('message_error','Terjadi Kesalahan');
        }
    }

    public function detail($id_karyawan)
    {
        if(empty($data_karyawan = karyawans::where('id', $id_karyawan)->where('id_user_ukm', $this->id_superadmin)->first()))
        {
            return abort(404);
        }
        $data_pass = [
            'agama' => $this->agama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'gol_darah' => $this->gol_darah,
            'status_kerja'=> $this->status_kerja,
            'data_karyawan' => $data_karyawan
        ];
        return view('user.superadmin_ukm.master.section.karyawan_perusahaan.karyawan_detail_page',$data_pass);
    }

}
