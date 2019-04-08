<?php

namespace App\Http\Controllers\administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Administrasi\Klien as klien;
use App\Model\Administrasi\SPKKontrak as spk;
use App\Model\Superadmin_sim\U_provinsi as provinsi;

use Session;

class SPKKontrak extends Controller
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
        $data = [
            'data_spk'=> spk::where('id_perusahaan', $this->id_perusahaan)->paginate(30)
        ];
        return view('user.administrasi.section.spk.page_default', $data);
    }

    public function cari(Request $req)
    {
        $yang_dicari =  $req->nm_spk;
        $data = [
            'data_spk'=> spk::where('nm_spk','LIKE',"%{$yang_dicari}%")->where('id_perusahaan', $this->id_perusahaan)->paginate(30)
        ];
        return view('user.administrasi.section.spk.page_default', $data);
    }

    public function create()
    {
        $data = [
            'klien'=> klien::all()->where('id_perusahaan', $this->id_perusahaan),
            'provinsi'=> provinsi::all()
        ];
        return view('user.administrasi.section.spk.page_create', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'no_spk'=> 'required',
            'nm_spk'=> 'required',
            'tgl_spk'=> 'required',
            'id_klien'=> 'required',
            'tgl_mulai'=> 'required',
            'tgl_akhir'=> 'required',
            'alamat'=> 'required',
            'id_prov'=> 'required',
            'id_kab'=> 'required',
        ]);

        $no_spk = $req->no_spk;
        $nm_spk = $req->nm_spk;
        $tgl_spk= date('Y-m-d', strtotime($req->tgl_spk));
        $id_klien= $req->id_klien;
        $tgl_mulai= date('Y-m-d', strtotime($req->tgl_mulai));
        $tgl_akhir= date('Y-m-d', strtotime($req->tgl_akhir));
        $alamat= $req->alamat;
        $id_prov= $req->id_prov;
        $id_kab= $req->id_kab;

        $model = new spk;
        $model->no_spk = $no_spk;
        $model->tgl_spk = $tgl_spk;
        $model->id_klien = $id_klien;
        $model->nm_spk = $nm_spk;
        $model->tgl_mulai = $tgl_mulai;
        $model->tgl_selesai = $tgl_akhir;
        $model->alamat = $alamat;
        $model->id_prov = $id_prov;
        $model->id_kab = $id_kab;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('SPK-Kontrak')->with('message_success','Anda telah menambahkan SPK Baru dengan no.SPK: '.$no_spk );
        }
        else
            {
                return redirect('SPK-Kontrak')->with('message_fail','Terjadi kesalahan, Silahkan coba lagi..!');
            }
    }

    public function edit($id)
    {
        if(empty($data_spk = spk::where('id', $id)->where('id_perusahaan', $this->id_perusahaan)->first()))
        {
            return abort(404);
        }

        $data = [
            'klien'=> klien::all()->where('id_perusahaan', $this->id_perusahaan),
            'provinsi'=> provinsi::all(),
            'spk'=> $data_spk
        ];
        return view('user.administrasi.section.spk.page_edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'no_spk'=> 'required',
            'nm_spk'=> 'required',
            'tgl_spk'=> 'required',
            'id_klien'=> 'required',
            'tgl_mulai'=> 'required',
            'tgl_akhir'=> 'required',
            'alamat'=> 'required',
            'id_prov'=> 'required',
            'id_kab'=> 'required',
        ]);

        $no_spk = $req->no_spk;
        $nm_spk = $req->nm_spk;
        $tgl_spk= date('Y-m-d', strtotime($req->tgl_spk));
        $id_klien= $req->id_klien;
        $tgl_mulai= date('Y-m-d', strtotime($req->tgl_mulai));
        $tgl_akhir= date('Y-m-d', strtotime($req->tgl_akhir));
        $alamat= $req->alamat;
        $id_prov= $req->id_prov;
        $id_kab= $req->id_kab;

        $model = spk::find($id);
        $model->no_spk = $no_spk;
        $model->tgl_spk = $tgl_spk;
        $model->id_klien = $id_klien;
        $model->nm_spk = $nm_spk;
        $model->tgl_mulai = $tgl_mulai;
        $model->tgl_selesai = $tgl_akhir;
        $model->alamat = $alamat;
        $model->id_prov = $id_prov;
        $model->id_kab = $id_kab;
        $model->id_perusahaan = $this->id_perusahaan;
        $model->id_karyawan = $this->id_karyawan;

        if($model->save())
        {
            return redirect('SPK-Kontrak')->with('message_success','Anda telah mengubah SPK Baru dengan no.SPK: '.$no_spk );
        }
        else
        {
            return redirect('SPK-Kontrak')->with('message_fail','Terjadi kesalahan, Silahkan coba lagi..!');
        }
    }

    public function delete(Request $req, $id)
    {
        $model = spk::find($id);
        if($model->delete())
        {
            return redirect('SPK-Kontrak')->with('message_success','Anda telah menghapus SPK Baru dengan no.SPK: '.$model->no_spk );
        }
        else
        {
            return redirect('SPK-Kontrak')->with('message_fail','Terjadi kesalahan, Silahkan coba lagi..!');
        }
    }

    public function uploadFileKontrak(Request $req)
    {
        $this->validate($req,[
            'id_spk'=> 'required',
            'file_kotrak'=> 'required|file|mimes:rar,zip',
        ]);

        $id = $req->id_spk;
        $file = $req->file_kotrak;

        $name_file =  uniqid().time().'.'.$file->getClientOriginalExtension();

        $cek_model = spk::find($id);
        if(!empty($cek_model->file_kotrak))
        {
            $file_path =public_path('fileSpk').'/' . $cek_model->file_kotrak;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }


        $model = spk::updateOrCreate(['id_perusahaan'=>$this->id_perusahaan,'id'=>$id],
            [
                'file_kotrak'=>$name_file,
            ]
        );



        if($model->save())
        {
            if ($file->move(public_path('fileSpk'), $name_file)) {
                return redirect('SPK-Kontrak')->with('message_success','Berhasil menyimpan File SPK dgn no.Spk :'.$model->no_spk);
            }else{
                return redirect('SPK-Kontrak')->with('message_error','Gagal menyimpan File SPK');
            }
        }

    }

    public function uploadFileScanSPK(Request $req)
    {
       $this->validate($req,[
            'id_file_scan'=> 'required',
            'file_scan'=> 'required|file|mimes:rar,zip',
        ]);

        $id = $req->id_file_scan;
        $file = $req->file_scan;

        $name_file =  uniqid().time().'.'.$file->getClientOriginalExtension();
        $cek_model = spk::find($id);
        if(!empty($cek_model->file_kotrak))
        {
            $file_path =public_path('fileScanSpk').'/' . $cek_model->file_scan;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        $model = spk::updateOrCreate(['id_perusahaan'=>$this->id_perusahaan,'id'=>$id],
            [
                'file_scan'=>$name_file,
            ]
        );


        if($model->save())
        {
            if ($file->move(public_path('fileScanSpk'), $name_file)) {
                return redirect('SPK-Kontrak')->with('message_success','Berhasil menyimpan File Scan SPK dgn no.Spk :'.$model->no_spk);
            }else{
                return redirect('SPK-Kontrak')->with('message_error','Gagal menyimpan File SPK');
            }
        }

    }

}
