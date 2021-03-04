<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Administrasi\SuratMasuk as surat_masuk;
use App\Model\Administrasi\SuratKeluar as surat_keluar;
use App\Model\Superadmin_ukm\U_jabatan_p as jabatan;
use App\Model\Administrasi\JenisSurat as jenis_surat;

class Surat extends Controller
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
        $data_pass = [
            'surat_masuk' => surat_masuk::all()->where('id_perusahaan', $this->id_perusahaan),
            'surat_keluar' => surat_keluar::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.administrasi.section.surat.page_default', $data_pass);
    }

    public function create_surat_masuk()
    {
        $data_pass =[
            'jabatan'=> jabatan::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.administrasi.section.surat.surat_masuk.page_create', $data_pass);
    }

    public function store_surat_masuk(Request $req)
    {
       // dd($req->all());
        $this->validate($req,[
           'tgl_surat_masuk' => 'required',
           'hal' => 'required',
           'dari' => 'required',
           'ditujukan' => 'required',
           'file_surat' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);

        $tgl_surat_masuk = date('Y-m-d', strtotime($req->tgl_surat_masuk));
        $hal = $req->hal;
        $dari = $req->dari;
        $ditujukan = $req->ditujukan;
        $file_surat = $req->file_surat;

        $name_file =   time().'_surat_masuk.'.$file_surat->getClientOriginalExtension();

        $model = new surat_masuk;
        $model->tgl_surat_masuk = $tgl_surat_masuk;
        $model->hal = $hal;
        $model->dari = $dari;
        $model->ditujukan = $ditujukan;
        $model->file_surat = $name_file;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            if ($file_surat->move(public_path('fileSuratMasuk'), $name_file)) {
                return redirect('Surat')->with('message_success','Anda baru saja menambahkan surat baru');
            }else{
                return redirect('Surat')->with('message_fail','Terjadi kesalahan, file surat gagal untuk diunggah');
            }
        }
    }

    public function ubah_surat_masuk($id)
    {
        if(empty($data_surat =surat_masuk::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        $data_pass =[
            'jabatan'=> jabatan::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_surat'=> $data_surat
        ];
        return view('user.administrasi.section.surat.surat_masuk.page_edit', $data_pass);
    }

    public function update_surat_masuk(Request $req, $id)
    {
        // dd($req->all());
        $this->validate($req,[
            'tgl_surat_masuk' => 'required',
            'hal' => 'required',
            'dari' => 'required',
            'ditujukan' => 'required',
            'file_surat' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);

        $tgl_surat_masuk = date('Y-m-d', strtotime($req->tgl_surat_masuk));
        $hal = $req->hal;
        $dari = $req->dari;
        $ditujukan = $req->ditujukan;
        $file_surat = $req->file_surat;

        $name_file =   time().'_surat_masuk.'.$file_surat->getClientOriginalExtension();

        $model = surat_masuk::findOrFail($id);

        if(!empty($model->file_surat))
        {
            $file_path =public_path('fileSuratMasuk').'/'. $model->file_surat;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }


        $model->tgl_surat_masuk = $tgl_surat_masuk;
        $model->hal = $hal;
        $model->dari = $dari;
        $model->ditujukan = $ditujukan;
        $model->file_surat = $name_file;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            if ($file_surat->move(public_path('fileSuratMasuk'), $name_file)) {
                return redirect('Surat')->with('message_success','Anda baru saja mengubah surat baru');
            }else{
                return redirect('Surat')->with('message_fail','Terjadi kesalahan, file surat gagal untuk diunggah');
            }
        }
    }


    public function delete_surat_masuk(Request $req, $id)
    {
        $model = surat_masuk::findOrFail($id);
        if (!empty($model->file_surat)) {
            $file_path = public_path('fileSuratMasuk') . '/' . $model->file_surat;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if ($model->delete())
        {
            return redirect('Surat')->with('message_success','Anda baru saja menghapus surat baru');
        }
        else{
                return redirect('Surat')->with('message_fail','Terjadi kesalahan, file surat gagal untuk diunggah');
        }
    }

    public function create_surat_keluar()
    {
        $data_pass =[
            'jenis_surat'=> jenis_surat::all()->where('id_perusahaan', $this->id_perusahaan)
        ];
        return view('user.administrasi.section.surat.surat_keluar.page_create', $data_pass);
    }

    public function store_surat_keluar(Request $req)
    {
        $this->validate($req,[
           'jenis_surat' => 'required',
		   'no_surat_keluar' => 'required',
		   'hal' => 'required',
		   'ditujukan' => 'required',
           'isi_surat' => 'required',
        ]);

        $jenis_surat = $req->jenis_surat;
		$no_surat_keluar = $req->no_surat_keluar;
		$hal = $req->hal;
		$ditujukan = $req->ditujukan;
        $isi_surat = $req->isi_surat;

        $model = new surat_keluar;
        $model->jenis_surat = $jenis_surat;
		$model->no_surat_keluar = $no_surat_keluar;
		$model->hal = $hal;
		$model->ditujukan = $ditujukan;
        $model->isi_surat = $isi_surat;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save())
        {
            return redirect('Surat')->with('message_success','Anda telah menambahkan surat keluar');
        }else
            {
                return redirect('Surat')->with('message_fail','Terjadi kesalahan, silahkan coba ..!!');
            }
    }


    public function edit_surat_keluar($id)
    {
        if(empty($data_surat_keluar = surat_keluar::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }
        $data_pass =[
            'jenis_surat'=> jenis_surat::all()->where('id_perusahaan', $this->id_perusahaan),
            'data_surat_keluar'=> $data_surat_keluar
        ];
        return view('user.administrasi.section.surat.surat_keluar.page_edit', $data_pass);
    }

    public function update_surat_keluar(Request $req, $id)
    {
        $this->validate($req,[
            'jenis_surat' => 'required',
            'isi_surat' => 'required',
        ]);

        $jenis_surat = $req->jenis_surat;
        $isi_surat = $req->isi_surat;

        $model = surat_keluar::findOrFail($id);
        $model->jenis_surat = $jenis_surat;
        $model->isi_surat = $isi_surat;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;
        if($model->save())
        {
            return redirect('Surat')->with('message_success','Anda telah mengubah surat keluar');
        }else
        {
            return redirect('Surat')->with('message_fail','Terjadi kesalahan, silahkan coba ..!!');
        }
    }

    public function delete_surat_keluar(Request $req, $id)
    {
        $model = surat_keluar::findOrFail($id);
        if($model->delete())
        {
            return redirect('Surat')->with('message_success','Anda telah menghapus surat keluar');
        }else
        {
            return redirect('Surat')->with('message_fail','Terjadi kesalahan, silahkan coba ..!!');
        }
    }

    public function ambil_surat_keluar($id)
    {
        if(empty($data_surat_keluar = surat_keluar::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first())){
            return abort(404);
        }

        $data_pass = [
            'data'=> $data_surat_keluar
        ];
        return response()->json($data_pass);
    }

    public function upload_surat_keluar(Request $req)
    {
        $this->validate($req,[
            'id' => 'required',
            'file_surat' => 'required|image|mimes:jpeg,png,gif',
       ]);
        $file_surat = $req->file_surat;
        $id= $req->id;
        $name_file =   time().'_surat_masuk.'.$file_surat->getClientOriginalExtension();
        $model = surat_keluar::findOrFail($id);
        if(!empty($model->scan_file))
        {
            $file_path =public_path('fileSuratKeluar').'/'. $model->scan_file;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }
        $model->scan_file = $name_file;
        if($model->save())
        {
            if ($file_surat->move(public_path('fileSuratKeluar'), $name_file)) {
                return redirect('Surat')->with('message_success','Anda baru saja meng-unggah file surat keluar');
            }else{
                return redirect('Surat')->with('message_fail','Terjadi kesalahan, file surat keluar gagal untuk di-unggah');
            }
        }
    }

    public function upload_status_surat_keluar(Request $req)
    { //validasi
        $this->validate($req,[
            'id_ubah' => 'required',
            'status_surat'=>'required',
			'tgl_dikirim' => 'required',
			'tanda_terima' => 'required',
        ]);
        $id= $req->id_ubah;
        $status_surat= $req->status_surat;
		$tgl_dikirim = date('Y-m-d', strtotime($req->tgl_dikirim));

        $model = surat_keluar::findOrFail($id);
        $model->status_surat = $status_surat;
		$model->tgl_dikirim = $tgl_dikirim;

        if($model->save())
        {
           return redirect('Surat')->with('message_success','Anda baru saja meng-unggah file surat keluar');
        }
        else
        {
           return redirect('Surat')->with('message_fail','Terjadi kesalahan, gagal untuk ubah status surat');
        }
    }
}
